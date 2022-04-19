<?php

namespace WPDeskFIVendor;

$params = isset($params) && \is_array($params) ? $params : [];
$actions = $params['actions'];
foreach ($actions as $action) {
    echo '<a target="blank" href="' . \esc_url($action['url']) . '" class="button wc-action-button ' . \esc_attr($action['action']) . '" aria-label="' . \esc_attr($action['name']) . '">';
    echo \esc_html($action['name']);
    echo '</a> ';
}
