<?php

namespace WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Helpers;

use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\InvoicesIntegration;
/**
 * Plugin helpers functions.
 *
 * @package WPDesk\Library\FlexibleInvoicesCore\Helpers
 */
class Plugin
{
    /**
     * @param string $plugin
     *
     * @return bool
     */
    public static function is_active(string $plugin) : bool
    {
        if (self::is_function_exists('is_plugin_active_for_network') && \is_plugin_active_for_network($plugin)) {
            return \true;
        }
        return \in_array($plugin, (array) \get_option('active_plugins', []), \true);
    }
    /**
     * @param string $name
     *
     * @return bool
     */
    public static function is_function_exists(string $name) : bool
    {
        return \function_exists($name);
    }
    /**
     * @return string
     */
    public static function get_activation_date() : string
    {
        $plugin = \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\InvoicesIntegration::$plugin_filename;
        $name = 'plugin_activation_' . $plugin;
        $value = \get_option($name, '');
        if (\is_string($value)) {
            return $value;
        }
        return '';
    }
    /**
     * @param string $date
     *
     * @return bool
     */
    public static function is_activation_date_is_greater_than(string $date) : bool
    {
        return \strtotime(self::get_activation_date()) > \strtotime($date . ' 00:00:00');
    }
    /**
     * @param string $date
     *
     * @return bool
     */
    public static function is_activation_date_is_less(string $date) : bool
    {
        return \strtotime(self::get_activation_date()) < \strtotime($date . ' 00:00:00');
    }
}
