<?php

namespace WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Helpers;

/**
 * Get country label from iso slug.
 *
 * @package WPDesk\Library\FlexibleInvoicesCore\Helpers
 */
class Countries
{
    /**
     * @param string $slug
     *
     * @return string
     */
    public static function get_country_label(string $slug) : string
    {
        if (\WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Helpers\WooCommerce::is_active() && \strlen($slug) <= 3) {
            $countries = \WC()->countries->get_countries();
            if (isset($countries)) {
                return $countries[$slug] ?? $slug;
            }
        }
        return $slug;
    }
}
