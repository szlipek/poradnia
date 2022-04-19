<?php

namespace WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\DocumentsFields;

use WPDeskFIVendor\WPDesk\Forms\Field\WooSelect;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Helpers\WooCommerce;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\InvoicesIntegration;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\Fields\SubEndField;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\Fields\SubStartField;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\Fields\WPMLFieldDecorator;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\SettingsStrategy\SettingsStrategy;
use WPDeskFIVendor\WPDesk\Forms\Field\Header;
use WPDeskFIVendor\WPDesk\Forms\Field\InputTextField;
use WPDeskFIVendor\WPDesk\Forms\Field\SelectField;
use WPDeskFIVendor\WPDesk\Forms\Field\TextAreaField;
/**
 * Invoice Proforma Document Settings Sub Page.
 *
 * @package WPDesk\Library\FlexibleInvoicesCore\Settings\DocumentsFields
 */
final class ProformaSettingsFields implements \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\DocumentsFields\DocumentsFieldsInterface
{
    /**
     * @var SettingsStrategy
     */
    private $strategy;
    /**
     * @param SettingsStrategy $strategy
     */
    public function __construct(\WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\SettingsStrategy\SettingsStrategy $strategy)
    {
        $this->strategy = $strategy;
    }
    /**
     * @return string
     */
    private function get_doc_link() : string
    {
        return \sprintf('<a href="%s" target="_blank">%s</a>', \esc_url(\get_locale() === 'pl_PL' ? 'https://www.wpdesk.pl/docs/faktury-woocommerce-docs/?utm_source=wp-admin-plugins&utm_medium=quick-link&utm_campaign=flexible-invoices-docs-link#proformy' : 'https://docs.flexibleinvoices.com/article/796-proforma-settings?utm_source=flexible-invoices-settings&utm_medium=link&utm_campaign=flexible-invoices-docs-link', ['https']), \esc_html__('Check how to issue proforma invoices.', 'flexible-invoices'));
    }
    /**
     * @return array
     */
    public function get_order_statuses() : array
    {
        $statuses = $this->strategy->get_order_statuses();
        unset($statuses['completed']);
        return $statuses;
    }
    /**
     * @return string
     */
    private function get_pro_class() : string
    {
        if (!\WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\InvoicesIntegration::is_super()) {
            return 'pro-version';
        }
        return '';
    }
    private function get_beacon_translations() : string
    {
        return 'Proforma Settings';
    }
    /**
     * @param string $name
     *
     * @return string
     */
    private function get_pro_name(string $name) : string
    {
        if (!\WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\InvoicesIntegration::is_super()) {
            return '';
        }
        return $name;
    }
    /**
     * @inheritDoc
     */
    public function get_fields() : array
    {
        $invoice_beacon = $this->get_beacon_translations();
        return [(new \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\Fields\SubStartField())->set_label(\esc_html__('Proforma', 'flexible-invoices'))->set_name('proforma')->add_class($this->get_pro_class()), (new \WPDeskFIVendor\WPDesk\Forms\Field\Header())->set_label(\esc_html__('Proforma Invoice Settings', 'flexible-invoices'))->set_description($this->get_doc_link()), (new \WPDeskFIVendor\WPDesk\Forms\Field\WooSelect())->set_name($this->get_pro_name('proforma_auto_create_status'))->set_label(\esc_html__('Issue proforma invoices automatically', 'flexible-invoices'))->set_description(\esc_html__('If you want to issue proforma invoices automatically, select order status. When the order status is changed to selected, a proforma invoice will be generated and a link to a PDF file will be attached to an e-mail.', 'flexible-invoices'))->set_options($this->get_order_statuses())->add_class('hs-beacon-search select2')->set_multiple()->set_attribute('data-beacon_search', $invoice_beacon), (new \WPDeskFIVendor\WPDesk\Forms\Field\InputTextField())->set_name($this->get_pro_name('proforma_start_number'))->set_label(\esc_html__('Next Number', 'flexible-invoices'))->set_default_value(1)->set_attribute('type', 'number')->add_class('edit_disabled_field hs-beacon-search')->set_attribute('disabled', 'disabled')->set_description(\esc_html__('Enter the next invoice number. The default value is 1 and changes every time an invoice is issued. Existing invoices won\'t be changed.', 'flexible-invoices'))->set_attribute('data-beacon_search', $invoice_beacon), (new \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\Fields\WPMLFieldDecorator((new \WPDeskFIVendor\WPDesk\Forms\Field\InputTextField())->set_name($this->get_pro_name('proforma_number_prefix'))->set_default_value(\esc_html__('Invoice Proforma', 'flexible-invoices'))->set_label(\esc_html__('Prefix', 'flexible-invoices'))->set_description(\wp_kses(\__('For prefixes use the following short tags: <code>{DD}</code> for day, <code>{MM}</code> for month, <code>{YYYY}</code> for year.', 'flexible-invoices'), ['code' => []]))->add_class('hs-beacon-search')->set_attribute('data-beacon_search', $invoice_beacon)))->get_field(), (new \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\Fields\WPMLFieldDecorator((new \WPDeskFIVendor\WPDesk\Forms\Field\InputTextField())->set_name($this->get_pro_name('proforma_number_suffix'))->set_default_value('/{MM}/{YYYY}')->set_label(\esc_html__('Suffix', 'flexible-invoices'))->set_description(\wp_kses(\__('For suffixes use the following short tags: <code>{DD}</code> for day, <code>{MM}</code> for month, <code>{YYYY}</code> for year.', 'flexible-invoices'), ['code' => []]))->add_class('hs-beacon-search')->set_attribute('data-beacon_search', $invoice_beacon)))->get_field(), (new \WPDeskFIVendor\WPDesk\Forms\Field\SelectField())->set_name($this->get_pro_name('proforma_number_reset_type'))->set_label(\esc_html__('Number Reset', 'flexible-invoices'))->set_description(\esc_html__('Select when to reset the invoice number to 1.', 'flexible-invoices'))->set_options(['year' => \esc_html__('Yearly', 'flexible-invoices'), 'month' => \esc_html__('Monthly', 'flexible-invoices'), 'none' => \esc_html__('None', 'flexible-invoices')])->set_default_value('month')->add_class('hs-beacon-search')->set_attribute('data-beacon_search', $invoice_beacon), (new \WPDeskFIVendor\WPDesk\Forms\Field\InputTextField())->set_name($this->get_pro_name('proforma_default_due_time'))->set_default_value(0)->set_attribute('type', 'number')->set_label(\esc_html__('Default Due Time', 'flexible-invoices'))->add_class('hs-beacon-search')->set_attribute('data-beacon_search', $invoice_beacon), (new \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\Fields\WPMLFieldDecorator((new \WPDeskFIVendor\WPDesk\Forms\Field\TextAreaField())->set_name($this->get_pro_name('proforma_notes'))->set_label(\esc_html__('Notes', 'flexible-invoices'))->add_class('large-text wide-input hs-beacon-search')->set_attribute('data-beacon_search', $invoice_beacon)))->get_field(), (new \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\Fields\SubEndField())->set_label('')];
    }
    /**
     * @inheritDoc
     */
    public static function get_tab_slug() : string
    {
        return 'proforma';
    }
    /**
     * @return string
     */
    public function get_tab_name() : string
    {
        return (string) \esc_html__('Proforma', 'flexible-invoices');
    }
}
