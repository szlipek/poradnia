<?php

namespace WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\WordPress;

use WP_User_Query;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Helpers\WooCommerce;
use WPDeskFIVendor\WPDesk\PluginBuilder\Plugin\Hookable;
/**
 * Search customer.
 *
 * @package WPDesk\Library\FlexibleInvoicesCore\WordPress
 */
class SearchCustomer implements \WPDeskFIVendor\WPDesk\PluginBuilder\Plugin\Hookable
{
    /**
     * @var string
     */
    const NONCE_ARG = 'security';
    /**
     * Fires hooks.
     */
    public function hooks()
    {
        \add_action('wp_ajax_invoice-get-client-data', [$this, 'get_customer_data_action']);
        \add_action('wp_ajax_woocommerce-invoice-user-select', [$this, 'select_ajax_user_search']);
    }
    /*
     * Search user via AJAX for user list
     *
     * @internal You should not use this directly from another application
     */
    public function select_ajax_user_search()
    {
        $client_options = [];
        if (\check_ajax_referer('inspire_invoices', self::NONCE_ARG, \false)) {
            $name = isset($_POST['name']) ? \sanitize_text_field(\wp_unslash($_POST['name'])) : '';
            if ($name) {
                $users = new \WP_User_Query(['search' => '*' . \esc_sql($name) . '*', 'search_columns' => ['user_login', 'user_nicename', 'user_email', 'user_url']]);
                $users_results = $users->get_results();
                $users_meta = new \WP_User_Query(['meta_query' => [
                    // phpcs:ignore
                    'relation' => 'OR',
                    ['key' => 'billing_first_name', 'value' => \esc_attr($name), 'compare' => 'LIKE'],
                    ['key' => 'billing_last_name', 'value' => \esc_attr($name), 'compare' => 'LIKE'],
                    ['key' => 'billing_company', 'value' => \esc_attr($name), 'compare' => 'LIKE'],
                ]]);
                $users_meta_results = $users_meta->get_results();
                $results = \array_merge($users_results, $users_meta_results);
                foreach ($results as $user) {
                    $client_options[$user->ID] = ['id' => $user->ID, 'text' => $this->prepare_option_text($user)];
                }
            }
            \wp_send_json(['items' => \array_values($client_options)]);
        }
        \wp_send_json($client_options);
    }
    /**
     * Process data from user object for select
     *
     * @param $user
     *
     * @return string
     */
    public function prepare_option_text($user)
    {
        $name = '';
        $user_meta = \get_user_meta($user->ID);
        if (isset($user_meta['billing_company'][0])) {
            $company = $user_meta['billing_company'][0];
            if (!empty($company)) {
                $name .= $company . ', ';
            }
        }
        if (isset($user_meta['billing_first_name'][0])) {
            $billing_first_name = $user_meta['billing_first_name'][0];
            if (!empty($billing_first_name)) {
                $name .= $user_meta['billing_first_name'][0] . ' ';
            }
        }
        if (isset($user_meta['billing_last_name'][0])) {
            $billing_last_name = $user_meta['billing_last_name'][0];
            if (!empty($billing_last_name)) {
                $name .= $user_meta['billing_last_name'][0] . ', ';
            }
        }
        $name .= $user->first_name . ' ';
        return $name . $user->last_name . ' (' . $user->user_login . ')';
    }
    /**
     * @return void
     *
     * @internal You should not use this directly from another application
     */
    public function get_customer_data_action()
    {
        if (isset($_REQUEST['client']) && \current_user_can('edit_posts') && \check_ajax_referer('inspire_invoices', self::NONCE_ARG, \false)) {
            $user = \get_user_by('id', (int) $_REQUEST['client']);
            if (!empty($user)) {
                $user_data = ['name' => $user->first_name . ' ' . $user->last_name, 'street' => '', 'street2' => '', 'postcode' => '', 'city' => '', 'nip' => '', 'country' => '', 'phone' => '', 'email' => $user->user_email];
                if (\WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Helpers\WooCommerce::is_active()) {
                    $user_data = ['name' => empty($user->billing_company) ? $user->billing_first_name . ' ' . $user->billing_last_name : $user->billing_company, 'street' => $user->billing_address_1, 'street2' => !empty($user->billing_address_2) ? $user->billing_address_2 : '', 'postcode' => $user->billing_postcode, 'city' => $user->billing_city, 'nip' => $user->vat_number, 'country' => $user->billing_country, 'phone' => $user->billing_phone, 'email' => $user->user_email];
                }
                /**
                 * Filters clients for Select2 library.
                 *
                 * @param array    $user_data   User data.
                 * @param string   $client_name Client name.
                 * @param \WP_User $user        User object.
                 *
                 * @since    1.2.3
                 * @internal Can be changed anytime.
                 */
                $userdata = \apply_filters('inspire_invoices_client_data', $user_data, (int) $_REQUEST['client'], $user);
                $result = ['result' => 'OK', 'code' => 100, 'userdata' => $userdata];
            } else {
                $result = ['result' => 'Fail', 'code' => 101];
            }
            \header('Content-Type: application/json');
            echo \json_encode($result);
            die;
        }
    }
}
