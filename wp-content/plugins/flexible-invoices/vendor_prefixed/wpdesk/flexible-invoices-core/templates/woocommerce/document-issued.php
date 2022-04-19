<?php

namespace WPDeskFIVendor;

$params = isset($params) && \is_array($params) ? $params : [];
$document_id = isset($params['document_id']) ? $params['document_id'] : 0;
$document_number = isset($params['document_number']) ? $params['document_number'] : 0;
$order_id = isset($params['order_id']) ? $params['order_id'] : 0;
$order_has_items = isset($params['order_has_items']) ? $params['order_has_items'] : \false;
$can_issued = isset($params['can_issued']) ? $params['can_issued'] : \false;
$can_edited = isset($params['can_edited']) ? $params['can_edited'] : \true;
$button_label = isset($params['button_label']) ? $params['button_label'] : \false;
$type = isset($params['type']) ? $params['type'] : \false;
$url = \wp_nonce_url(\admin_url('admin-ajax.php?action=woocommere-generate-document&order_id=' . $order_id) . '&single_order=1');
$actions = [];
if ($document_id) {
    if ($document_id) {
        $document_id = \esc_attr((int) $document_id);
        $actions[] = ['url' => \wp_nonce_url(\admin_url('admin-ajax.php?action=invoice-get-pdf-invoice&id=' . $document_id)), 'name' => \esc_html__('View', 'flexible-invoices'), 'action' => 'button view-invoice', 'hint' => \esc_html__('View', 'flexible-invoices'), 'id' => 'view_' . $type];
        $actions[] = ['url' => \wp_nonce_url(\admin_url('admin-ajax.php?action=invoice-get-pdf-invoice&id=' . $document_id . '&save_file=1')), 'name' => \esc_html__('Download', 'flexible-invoices'), 'action' => 'button get-invoice', 'hint' => \esc_html__('Download', 'flexible-invoices'), 'id' => 'download_' . $type];
    } else {
        if ($order_has_items) {
            $actions[] = ['url' => \wp_nonce_url(\admin_url('admin-ajax.php?action=woocommere-generate-document&order_id=' . $order_id . '&single_order=1')), 'name' => \esc_html__('Issue', 'flexible-invoices'), 'action' => 'button generate-invoice', 'id' => 'generate_' . $type];
        }
    }
    $edit_url = \admin_url('post.php?post=' . $document_id . '&action=edit');
    if ($can_edited) {
        echo '<p><a id="edit_' . \sanitize_key($type) . '" href="' . \esc_url($edit_url) . '" class="edit-invoice" data-tip="' . \esc_html__('Edit Invoice', 'flexible-invoices') . '">';
        echo \esc_html($document_number);
        echo '</a></p>';
    } else {
        echo '<p>' . \esc_html($document_number) . '</p>';
    }
    echo '<p>';
    foreach ($actions as $action) {
        echo '<a id="' . \esc_attr($action['id']) . '" target="blank" href="' . \esc_attr($action['url']) . '" class="' . \esc_attr($action['action']) . '" data-tip="' . \esc_attr($action['hint']) . '">';
        echo \esc_html($action['name']);
        echo '</a>';
    }
    echo '</p>';
} else {
    if ($can_issued && $can_edited) {
        echo '<p><a id="generate_' . \sanitize_key($type) . '" target="blank" href="' . \esc_url($url) . '&type=' . \sanitize_key($type) . '" class="button generate-invoice document-' . \sanitize_key($type) . '" data-tip="">';
        echo \esc_html($button_label);
        echo '</a></p>';
    }
}
