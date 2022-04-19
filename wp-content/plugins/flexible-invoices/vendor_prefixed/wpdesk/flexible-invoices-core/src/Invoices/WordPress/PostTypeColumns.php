<?php

/**
 * Invoices. Invoice post columns.
 *
 * @package WPDesk\Library\FlexibleInvoicesCore
 */
namespace WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\WordPress;

use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Decorators\DocumentDecorator;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesAbstracts\Documents\Document;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Helpers\WooCommerce;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Integration\DocumentFactory;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\SettingsStrategy\SettingsStrategy;
use WPDeskFIVendor\WPDesk\PluginBuilder\Plugin\Hookable;
/**
 * Add custom columns in documents listing.
 *
 * @package WPDesk\Library\FlexibleInvoicesCore\Integration
 */
class PostTypeColumns implements \WPDeskFIVendor\WPDesk\PluginBuilder\Plugin\Hookable
{
    /**
     * @var SettingsStrategy
     */
    private $strategy;
    /**
     * @var DocumentFactory
     */
    private $document_factory;
    /**
     * @param SettingsStrategy $strategy
     * @param DocumentFactory  $document_factory
     */
    public function __construct(\WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\SettingsStrategy\SettingsStrategy $strategy, \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Integration\DocumentFactory $document_factory)
    {
        $this->strategy = $strategy;
        $this->document_factory = $document_factory;
    }
    /**
     * Fires hooks.
     */
    public function hooks()
    {
        $post_type = \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\WordPress\RegisterPostType::POST_TYPE_NAME;
        \add_filter('manage_edit-' . $post_type . '_columns', [$this, 'add_custom_columns_filter']);
        \add_action('manage_' . $post_type . '_posts_custom_column', [$this, 'custom_columns_body_action'], 10, 2);
    }
    /**
     * @param array $columns
     *
     * @return array
     *
     * @internal You should not use this directly from another application
     */
    public function add_custom_columns_filter(array $columns) : array
    {
        unset($columns['date'], $columns['title']);
        $columns['invoice_title'] = \esc_html__('Invoice', 'flexible-invoices');
        $columns['client'] = \esc_html__('Customer', 'flexible-invoices');
        $columns['netto'] = \esc_html__('Net price', 'flexible-invoices');
        $columns['gross'] = \esc_html__('Gross price', 'flexible-invoices');
        $columns['issue'] = \esc_html__('Issue date', 'flexible-invoices');
        $columns['pay'] = \esc_html__('Due date', 'flexible-invoices');
        $columns['sale'] = \esc_html__('Date of sale', 'flexible-invoices');
        $columns['order'] = \esc_html__('Order', 'flexible-invoices');
        $columns['status'] = \esc_html__('Payment status', 'flexible-invoices');
        $columns['currency'] = \esc_html__('Currency', 'flexible-invoices');
        $columns['paymethod'] = \esc_html__('Payment method', 'flexible-invoices');
        $columns['actions'] = \esc_html__('Actions', 'flexible-invoices');
        return \apply_filters('fi/core/lists/columns/header', $columns);
    }
    /**
     * @param string $column_name Column name,
     * @param int    $post_id     Post ID.
     *
     * @internal You should not use this directly from another application
     */
    public function custom_columns_body_action(string $column_name, int $post_id)
    {
        //phpcs:ignore
        global $post;
        $creator = $this->document_factory->get_document_creator($post->ID);
        $document = $creator->get_document();
        $document = new \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Decorators\DocumentDecorator($document, $this->strategy);
        switch ($column_name) {
            case 'invoice_title':
                $duplicates = $this->find_duplicates($post->post_title);
                $class = '';
                $title_duplicated = '';
                if ($duplicates > 1) {
                    $class = 'is_duplicated';
                    $title_duplicated = \esc_html__('The name of invoice is duplicated!', 'flexible-invoices');
                }
                if (empty($post->post_title)) {
                    $post->post_title = $document->get_formatted_number();
                }
                if (!$creator->is_allowed_for_edit()) {
                    echo \sprintf('<span class="%1$s"><strong>%2$s</strong></span>', \esc_attr($class), \esc_html($post->post_title));
                } else {
                    echo \sprintf('<strong><a class="%1$s" title="%2$s" href="%3$s">%4$s</a></strong>', \esc_attr($class), \esc_html($title_duplicated), \esc_url(\get_edit_post_link($post_id)), \esc_html($post->post_title));
                }
                break;
            case 'client':
                echo \esc_html($document->get_customer()->get_name());
                break;
            case 'netto':
                echo \esc_html($document->get_total_net());
                break;
            case 'gross':
                echo \esc_html($document->get_total_gross());
                break;
            case 'issue':
                echo \esc_html($document->get_date_of_issue());
                break;
            case 'pay':
                echo \esc_html($document->get_date_of_pay());
                break;
            case 'order':
                $order_id = $document->get_order_id();
                if ($order_id) {
                    $order_number = $order_id;
                    if (\WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Helpers\WooCommerce::is_active()) {
                        $order = \wc_get_order($order_id);
                        if ($order) {
                            $order_number = $order->get_order_number();
                        }
                    }
                    echo '<a href="' . \admin_url('post.php?post=' . (int) $order_id . '&action=edit') . '">' . \esc_html($order_number) . '</a>';
                    //phpcs:ignore
                }
                break;
            case 'status':
                echo \esc_html($document->get_payment_status_name());
                break;
            case 'sale':
                echo \esc_html($document->get_date_of_sale());
                break;
            case 'currency':
                echo \esc_html($document->get_currency());
                break;
            case 'paymethod':
                echo \esc_html($document->get_payment_method_name());
                break;
            case 'actions':
                echo '<a target="_blank" href="' . \site_url() . '/wp-admin/admin-ajax.php?action=invoice-get-pdf-invoice&amp;id=' . $document->get_id() . '&amp;hash=' . \md5(NONCE_SALT . $document->get_id()) . '" class="button tips dashicons view-invoice" title="' . \esc_attr__('View Invoice', 'flexible-invoices') . '">' . \esc_html__('View Invoice', 'flexible-invoices') . '</a>';
                //phpcs:ignore
                echo '<a target="_blank" href="' . \site_url() . '/wp-admin/admin-ajax.php?action=invoice-get-pdf-invoice&amp;id=' . $document->get_id() . '&amp;hash=' . \md5(NONCE_SALT . $document->get_id()) . '&save_file=1" class="button tips dashicons get-invoice" title="' . \esc_attr__('Download Invoice', 'flexible-invoices') . '">' . \esc_html__('Download Invoice', 'flexible-invoices') . '</a>';
                //phpcs:ignore
                break;
            default:
                echo \esc_html(\get_post_meta($post_id, '_invoice_' . $column_name, \true));
                break;
        }
        /**
         * Adds body for custom columns to the documents list.
         *
         * @param array    $column_name Column name.
         * @param Document $document    Document.
         *
         * @since 3.0.0
         */
        \do_action('fi/core/lists/columns/body', $column_name, $document);
    }
    /**
     * Find duplicates.
     *
     * @param string $post_title Post title.
     *
     * @return int
     */
    private function find_duplicates(string $post_title) : int
    {
        global $wpdb;
        $duplicates = $wpdb->get_var($wpdb->prepare("SELECT count(ID) FROM {$wpdb->posts} WHERE `post_title` = %s AND `post_type` = %s AND `post_status` = 'publish'", $post_title, \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\WordPress\RegisterPostType::POST_TYPE_NAME));
        //phpcs:ignore
        return (int) $duplicates;
    }
}
