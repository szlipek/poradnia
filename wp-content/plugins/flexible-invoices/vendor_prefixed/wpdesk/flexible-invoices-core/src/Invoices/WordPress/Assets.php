<?php

namespace WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\WordPress;

use WP_Screen;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\LibraryInfo;
use WPDeskFIVendor\WPDesk\PluginBuilder\Plugin\Hookable;
class Assets implements \WPDeskFIVendor\WPDesk\PluginBuilder\Plugin\Hookable
{
    const SCRIPTS_VERSION = '1.9';
    const INVOICE_NAMESPACE = 'inspire_invoices';
    const INVOICE_PAGE_ID = 'inspire_invoice';
    const INVOICE_EDIT_PAGE_ID = 'edit-inspire_invoice';
    const SETTINGS_PAGE_ID = 'inspire_invoice_page_invoices_settings';
    const DOWNLOAD_PAGE_ID = 'inspire_invoice_page_download';
    const REPORTS_PAGE_ID = 'inspire_invoice_page_flexible-invoices-reports-settings';
    /**
     * @var LibraryInfo
     */
    private $library_info;
    /**
     * @var string
     */
    private $plugin_assets_js;
    /**
     * @var string
     */
    private $plugin_assets_css;
    /**
     * @param LibraryInfo $library_info
     */
    public function __construct(\WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\LibraryInfo $library_info)
    {
        $this->library_info = $library_info;
        $this->set_assets_urls();
    }
    /**
     * Fire hooks.
     */
    public function hooks()
    {
        \add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts']);
    }
    /**
     * Set assets URLs.
     */
    private function set_assets_urls()
    {
        $this->plugin_assets_js = $this->library_info->get_assets_url() . 'js/';
        $this->plugin_assets_css = $this->library_info->get_assets_url() . 'css/';
    }
    /**
     * Admin enqueue scripts.
     */
    public function admin_enqueue_scripts()
    {
        $screen = \get_current_screen();
        if ($screen) {
            $this->enqueue_select2_scripts($screen);
            $this->enqueue_order_action_scripts($screen);
            $this->enqueue_post_type_scripts($screen);
            $this->enqueue_settings_scripts($screen);
            $this->enqueue_product_search_scripts($screen);
        }
    }
    /**
     * @param WP_Screen $screen
     *
     * @internal You should not use this directly from another application
     */
    private function enqueue_product_search_scripts(\WP_Screen $screen)
    {
        if (\in_array($screen->id, [self::INVOICE_PAGE_ID, self::INVOICE_EDIT_PAGE_ID], \true)) {
            \wp_enqueue_script('fiw-products', $this->plugin_assets_js . 'products.js', ['fiw-admin'], self::SCRIPTS_VERSION, \true);
            \wp_localize_script('fiw-products', 'fiw_localize', ['nonce' => \wp_create_nonce('fiw_search_products')]);
        }
    }
    /**
     * @param WP_Screen $screen
     *
     * @internal You should not use this directly from another application
     */
    private function enqueue_post_type_scripts(\WP_Screen $screen)
    {
        if (\in_array($screen->id, [self::INVOICE_PAGE_ID, self::INVOICE_EDIT_PAGE_ID], \true)) {
            \wp_enqueue_style('fiw-admin-style', $this->plugin_assets_css . 'admin.css', [], self::SCRIPTS_VERSION);
            \wp_enqueue_style('fiw-actions-style', $this->plugin_assets_css . 'admin-order.css', [], self::SCRIPTS_VERSION);
            \wp_enqueue_style('jquery-ui-style', '//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/smoothness/jquery-ui.css', [], self::SCRIPTS_VERSION);
        }
        \wp_enqueue_script('jquery');
        \wp_enqueue_script('jquery-ui');
        \wp_enqueue_media();
        if (\in_array($screen->id, [self::INVOICE_PAGE_ID, self::INVOICE_EDIT_PAGE_ID, 'edit-shop_order', 'shop_order', self::SETTINGS_PAGE_ID], \true)) {
            $upgrade_link = \get_locale() === 'pl_PL' ? 'https://www.wpdesk.pl/sklep/faktury-woocommerce/?utm_source=wp-admin-plugins&utm_medium=quick-link&utm_campaign=flexible-invoices-plugins-upgrade-link' : 'https://www.flexibleinvoices.com/products/flexible-invoices-woocommerce/?utm_source=wp-admin-plugins&utm_medium=link&utm_campaign=flexible-invoices-plugins-upgrade-link';
            $inspire_invoice_params = ['plugin_url' => $this->library_info, 'message_generating' => \esc_html__('Generate, please wait ...', 'flexible-invoices'), 'message_generating_successful' => \esc_html__('Completed successfully.', 'flexible-invoices'), 'message_generating_error' => \esc_html__('An unexpected error occurred: ', 'flexible-invoices'), 'message_confirm' => \esc_html__('The data was not saved. Generate a PDF?', 'flexible-invoices'), 'message_invoice_sent' => \esc_html__('You have sent an invoice to: ', 'flexible-invoices'), 'message_invoice_not_sent_woo' => \esc_html__('You can not send an invoice not issued for the WooCommerce order.', 'flexible-invoices'), 'message_not_sent' => \esc_html__('Could not send invoice.', 'flexible-invoices'), 'message_not_saved_changes' => \esc_html__('Note, unsaved changes will not be included in the email you send.', 'flexible-invoices'), 'select2_placeholder' => \esc_html__('Search...', 'flexible-invoices'), 'select2_min_chars' => \esc_html__('Minimum length %.', 'flexible-invoices'), 'select2_loading_more' => \esc_html__('More...', 'flexible-invoices'), 'select2_no_results' => \esc_html__('No results.', 'flexible-invoices'), 'select2_searching' => \esc_html__('Searching...', 'flexible-invoices'), 'select2_error_loading' => \esc_html__('Cannot load data...', 'flexible-invoices'), 'get_pro_version_text' => \esc_html__('Upgrade to PRO', 'flexible-invoices'), 'get_pro_version_url' => $upgrade_link, 'ajax_nonce' => \wp_create_nonce(self::INVOICE_NAMESPACE)];
            \wp_enqueue_script('fiw-admin', $this->plugin_assets_js . 'admin.js', ['jquery'], self::SCRIPTS_VERSION, \true);
            \wp_localize_script('fiw-admin', 'inspire_invoice_params', $inspire_invoice_params);
        }
    }
    /**
     * @param WP_Screen $screen
     *
     * @internal You should not use this directly from another application
     */
    private function enqueue_settings_scripts(\WP_Screen $screen)
    {
        $tab = $_GET['tab'] ?? '';
        //phpcs:ignore
        if (\in_array($screen->id, [self::SETTINGS_PAGE_ID, self::DOWNLOAD_PAGE_ID, self::REPORTS_PAGE_ID], \true)) {
            \wp_enqueue_script('jquery-ui');
            \wp_enqueue_media();
            \wp_enqueue_style('jquery-ui-style', '//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/smoothness/jquery-ui.css', [], self::SCRIPTS_VERSION);
            \wp_enqueue_style('fiw-settings-style', $this->plugin_assets_css . 'settings.css', [], self::SCRIPTS_VERSION);
            \wp_enqueue_script('fiw-settings', $this->plugin_assets_js . 'settings.js', ['jquery'], self::SCRIPTS_VERSION, \true);
            \wp_enqueue_script('fiw-tip-tip', $this->plugin_assets_js . 'jquery.tipTip.js', ['jquery'], self::SCRIPTS_VERSION);
            if ($tab === 'invoice-template') {
                \wp_enqueue_style('wp-color-picker');
                \wp_enqueue_script('wp-color-picker');
                \wp_enqueue_style('fiw-template-settings', $this->plugin_assets_css . 'template-settings.css', [], self::SCRIPTS_VERSION);
                \wp_enqueue_script('fiw-template-settings', $this->plugin_assets_js . 'template-settings.js', ['jquery'], self::SCRIPTS_VERSION, \true);
            }
        }
    }
    /**
     * @param WP_Screen $screen
     */
    private function enqueue_order_action_scripts(\WP_Screen $screen)
    {
        if (\in_array($screen->id, ['edit-shop_order', 'shop_order'], \true)) {
            \wp_enqueue_style('fiw-order-style', $this->plugin_assets_css . 'admin-order.css', [], self::SCRIPTS_VERSION);
            \wp_enqueue_script('fiw-order', $this->plugin_assets_js . 'orders.js', ['jquery'], self::SCRIPTS_VERSION, \true);
        }
    }
    /**
     * @param WP_Screen $screen
     *
     * @internal You should not use this directly from another application
     */
    private function enqueue_select2_scripts(\WP_Screen $screen)
    {
        if ($this->select2_visibility($screen)) {
            \wp_enqueue_style('fiw-select2-style', $this->plugin_assets_css . 'select2.min.css', [], self::SCRIPTS_VERSION);
            \wp_enqueue_script('fiw-select2-pl', $this->plugin_assets_js . 'select2-pl.js', ['jquery'], self::SCRIPTS_VERSION, \true);
            \wp_enqueue_script('fiw-select2-script', $this->plugin_assets_js . 'select2.min.js', ['jquery'], self::SCRIPTS_VERSION, \false);
        }
    }
    /**
     * Check current screen for select2 scripts
     *
     * @return bool
     */
    private function select2_visibility($screen)
    {
        return self::INVOICE_PAGE_ID === $screen->id || self::INVOICE_EDIT_PAGE_ID === $screen->id || self::SETTINGS_PAGE_ID === $screen->id || 'inspire_invoice_page_flexible-invoices-settings' === $screen->id;
    }
}
