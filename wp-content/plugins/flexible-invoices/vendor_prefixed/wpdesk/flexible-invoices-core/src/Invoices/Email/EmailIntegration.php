<?php

namespace WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Email;

use WC_Order;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesAbstracts\Documents\Document;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Helpers\Invoice;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Helpers\WooCommerce;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Infrastructure\Request;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Integration\DocumentFactory;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\WordPress\PDF;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\WordPress\Translator;
use WPDeskFIVendor\WPDesk\PluginBuilder\Plugin\Hookable;
use function WC;
/**
 * @package WPDesk\Library\FlexibleInvoicesCore\Email
 */
class EmailIntegration implements \WPDeskFIVendor\WPDesk\PluginBuilder\Plugin\Hookable
{
    /**
     * @var DocumentFactory
     */
    private $document_factory;
    /**
     * @var PDF
     */
    private $pdf;
    /**
     * @param DocumentFactory $document_factory
     * @param PDF             $pdf
     */
    public function __construct(\WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Integration\DocumentFactory $document_factory, \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\WordPress\PDF $pdf)
    {
        $this->document_factory = $document_factory;
        $this->pdf = $pdf;
    }
    /**
     * Fire hooks.
     */
    public function hooks()
    {
        \add_action('wp_ajax_invoice-send-by-email', [$this, 'send_invoice_by_email_action']);
        \add_action('fi/core/edit/metabox/publish', [$this, 'add_send_email_button']);
    }
    /**
     * @param Document $document
     *
     * @internal You should not use this directly from another application
     */
    public function add_send_email_button(\WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesAbstracts\Documents\Document $document)
    {
        if ($document->get_id() && \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Helpers\WooCommerce::is_active()) {
            $creator = $this->document_factory->get_document_creator($document->get_id());
            if ($document->get_order_id() && $creator->is_allowed_to_send()) {
                echo '<button data-id="' . \esc_attr($document->get_id()) . '" data-type="fi_' . \esc_attr($document->get_type()) . '" data-hash="' . \esc_attr(\WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Helpers\Invoice::document_hash($document)) . '" class="button button-primary button-large send_invoice">' . \esc_html__('Send by e-mail', 'flexible-invoices') . '</button>';
            }
        }
    }
    /**
     * @return void
     *
     * @internal You should not use this directly from another application
     */
    public function send_invoice_by_email_action()
    {
        $request = new \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Infrastructure\Request();
        $id = (int) $request->param('post.id')->get();
        $email_class = $request->param('post.email_class')->get();
        if ($id) {
            $document = $this->document_factory->get_document_creator($id)->get_document();
            $order_id = $document->get_order_id();
            if ($order_id) {
                $order = \wc_get_order($order_id);
                $client = $document->get_customer();
                $send = $this->send_email($order, $document, $email_class);
                if ($send) {
                    \wp_send_json_success(['code' => 100, 'invoice_number' => $document->get_formatted_number(), 'result' => 'OK', 'email' => $client->get_email()]);
                }
            } else {
                \wp_send_json_error(['code' => 101, 'invoice_number' => $document->get_formatted_number(), 'result' => 'Fail']);
            }
        }
        \wp_send_json_error(['code' => 101, 'invoice_number' => '', 'result' => 'Fail']);
    }
    /**
     * @param WC_Order $order
     * @param Document $document
     * @param string   $email_class
     *
     * @return bool
     */
    public function send_email(\WC_Order $order, \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesAbstracts\Documents\Document $document, string $email_class) : bool
    {
        \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\WordPress\Translator::switch_lang($document->get_user_lang());
        \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\WordPress\Translator::set_translate_lang($document->get_user_lang());
        $mailer = \WC()->mailer();
        $emails = $mailer->get_emails();
        $client = $document->get_customer();
        if (!empty($emails[$email_class]) && !empty($client->get_email())) {
            if ($emails[$email_class] instanceof \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Email\DocumentEmail) {
                $emails[$email_class]->should_send_email($order, $document, $this->pdf);
            }
            return \true;
        }
        return \false;
    }
}
