<?php

/**
 * Woocommerce Settings.
 *
 * @package WPDesk\FlexibleInvoicesWooCommerce
 */
namespace WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\WooCommerceFields;

use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\InvoicesIntegration;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\Fields\FICheckboxField;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\Fields\SubEndField;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\Fields\SubStartField;
use WPDeskFIVendor\WPDesk\Forms\Field\Header;
use WPDeskFIVendor\WPDesk\Forms\Field\SelectField;
/**
 * General settings subpage.
 *
 * @package WPDesk\Library\FlexibleInvoicesCore\Settings\WooCommerceFields
 */
final class GeneralSettingsFields implements \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\WooCommerceFields\SubTabInterface
{
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
    /**
     * @return string
     */
    private function get_doc_link() : string
    {
        $docs_link = \get_locale() === 'pl_PL' ? 'https://www.wpdesk.pl/docs/faktury-woocommerce-docs/' : 'https://docs.flexibleinvoices.com/';
        return \sprintf('<a href="%s" target="_blank">%s</a>', \esc_url($docs_link . '?utm_source=flexible-invoices-woocommerce-settings&utm_medium=link&utm_campaign=settings-docs-link'), \esc_html__('Read WooCommerce integration manual &rarr;', 'flexible-invoices'));
    }
    /**
     * @return array
     */
    private function get_exchange_currencies() : array
    {
        $currencies_options = [];
        $currencies = ['AUD' => 'AUD', 'BGN' => 'BGN', 'CAD' => 'CAD', 'CHF' => 'CHF', 'CNY' => 'CNY', 'CZK' => 'CZK', 'DKK' => 'DKK', 'PLN' => 'PLN', 'EUR' => 'EUR', 'HRK' => 'HRK', 'HUF' => 'HUF', 'GBP' => 'GBP', 'ILS' => 'ILS', 'JPY' => 'JPY', 'NOK' => 'NOK', 'RON' => 'RON', 'SEK' => 'SEK'];
        foreach ($currencies as $currency_code => $currency_name) {
            $currencies_options[$currency_code] = $currency_name;
        }
        return $currencies_options;
    }
    /**
     * @inheritDoc
     */
    public function get_fields() : array
    {
        $general = 'Main Settings for WooCommerce';
        return [(new \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\Fields\SubStartField())->set_label(\esc_html__('General', 'flexible-invoices'))->set_name('general'), (new \WPDeskFIVendor\WPDesk\Forms\Field\Header())->set_label(\esc_html__('WooCommerce Settings', 'flexible-invoices'))->set_description($this->get_doc_link()), (new \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\Fields\FICheckboxField())->set_name('woocommerce_sequential_orders')->set_label(\esc_html__('Sequential Order Numbers', 'flexible-invoices'))->set_sublabel(\esc_html__('Enable', 'flexible-invoices'))->set_description(\esc_html__('In new stores, order numbers begin from 1. In existing stores numbers continue from the last order number.', 'flexible-invoices'))->set_attribute('data-beacon_search', $general)->add_class('hs-beacon-search'), (new \WPDeskFIVendor\WPDesk\Forms\Field\SelectField())->set_name('woocommerce_date_of_sale')->set_label(\esc_html__('Date of sale on the invoice', 'flexible-invoices'))->set_description(\esc_html__('Set which date will be the date of sale on the invoice.', 'flexible-invoices'))->set_options(['order_date' => \esc_html__('Use order date', 'flexible-invoices'), 'order_completed' => \esc_html__('Use order completed date', 'flexible-invoices')])->set_attribute('data-beacon_search', $general)->add_class('hs-beacon-search'), (new \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\Fields\FICheckboxField())->set_name('woocommerce_zero_invoice')->set_label(\esc_html__('Free Orders', 'flexible-invoices'))->set_sublabel(\esc_html__('Do not automatically issue invoices for free orders', 'flexible-invoices'))->set_attribute('data-beacon_search', $general)->add_class('hs-beacon-search'), (new \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\Fields\FICheckboxField())->set_name('woocommerce_zero_product')->set_label(\esc_html__('Free line items', 'flexible-invoices'))->set_sublabel(\esc_html__('Do not add free line items to invoices (includes free products and free shipping)', 'flexible-invoices'))->set_attribute('data-beacon_search', $general)->add_class('hs-beacon-search'), (new \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\Fields\FICheckboxField())->set_name('woocommerce_add_order_id')->set_label(\esc_html__('Order number', 'flexible-invoices'))->set_sublabel(\esc_html__('Add order number to an invoice', 'flexible-invoices'))->set_attribute('data-beacon_search', $general)->add_class('hs-beacon-search'), (new \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\Fields\FICheckboxField())->set_name('woocommerce_currency_exchange_enable')->set_label(\esc_html__('Currency exchange table', 'flexible-invoices'))->set_sublabel(\esc_html__('Enable', 'flexible-invoices'))->set_description(\esc_html__('This option adds to the invoice a table with the conversion of the VAT value into local currency.', 'flexible-invoices'))->add_class('hs-beacon-search ' . $this->get_pro_class())->set_attribute('data-beacon_search', $general), (new \WPDeskFIVendor\WPDesk\Forms\Field\SelectField())->set_name('woocommerce_target_exchange_currency')->set_label(\esc_html__('Exchange to currency', 'flexible-invoices'))->set_description(\esc_html__('Exchange rates are taken from European Central Bank table at the most recent exchange rate.', 'flexible-invoices'))->set_options($this->get_exchange_currencies())->add_class('exchange-table-fields hs-beacon-search')->set_attribute('data-beacon_search', $general), (new \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\Fields\SubEndField())->set_label('')];
    }
    /**
     * @return string
     */
    public static function get_tab_slug() : string
    {
        return 'general';
    }
    /**
     * @return string
     */
    public function get_tab_name() : string
    {
        return \esc_html__('General', 'flexible-invoices');
    }
}
