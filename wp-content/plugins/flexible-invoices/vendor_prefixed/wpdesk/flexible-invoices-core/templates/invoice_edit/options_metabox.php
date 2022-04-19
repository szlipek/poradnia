<?php

namespace WPDeskFIVendor;

use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesAbstracts\Documents\Document;
/**
 * @var array $params
 */
$params = isset($params) ? $params : [];
/**
 * @var Document $invoice
 */
$invoice = $params['invoice'];
$document_issuing = 'Manual Issuing Proforma and Invoices';
?>

<div class="form-wrap inspire-panel">
	<?php 
/**
 * Fires before options meta box is rendered.
 *
 * @param Document $invoice Document type.
 * @param array    $params  Array of params.
 *
 * @since 3.0.0
 */
\do_action('fi/core/layout/metabox/options/before', $invoice, $params);
?>
	<div class="form-field form-required">
		<label for="inspire_invoices_date_issue"><?php 
\esc_html_e('Issue date', 'flexible-invoices');
?></label>
		<input data-beacon_search="<?php 
echo \esc_attr($document_issuing);
?>" id="inspire_invoices_date_issue" class="hs-beacon-search" type="date" name="date_issue" value="<?php 
echo \esc_attr($invoice->get_date_of_issue());
?>" />
	</div>

	<div class="form-field form-required">
		<label for="inspire_invoices_date_sale"><?php 
\esc_html_e('Date of sale', 'flexible-invoices');
?></label>
		<input data-beacon_search="<?php 
echo \esc_attr($document_issuing);
?>" id="inspire_invoices_date_sale" class="hs-beacon-search" type="date" name="date_sale" value="<?php 
echo \esc_attr($invoice->get_date_of_sale());
?>" />
	</div>

	<div class="form-field form-required">
		<label for="inspire_invoices_date_pay"><?php 
\esc_html_e('Due date', 'flexible-invoices');
?></label>
		<input data-beacon_search="<?php 
echo \esc_attr($document_issuing);
?>" id="inspire_invoices_date_pay" class="hs-beacon-search" type="date" name="date_pay" value="<?php 
echo \esc_attr($invoice->get_date_of_pay());
?>" />
	</div>

	<div class="metabox-actions">
        <?php 
$hash = \md5(\NONCE_SALT . $invoice->get_id());
$id = $invoice->get_id();
?>
		<a id="download_document" href="<?php 
echo \admin_url('admin-ajax.php?action=invoice-get-pdf-invoice&id=' . $id . '&hash=' . $hash . '&save_file=1');
?>" class="button button-large"><?php 
\esc_html_e('Download Invoice', 'flexible-invoices');
?></a>
		<?php 
\do_action('fi/core/edit/metabox/publish', $invoice);
?>
	</div>

	<?php 
/**
 * Fires after options meta box is rendered.
 *
 * @param Document $invoice Document type.
 * @param array    $params  Array of params.
 *
 * @since 3.0.0
 */
\do_action('fi/core/layout/metabox/options/after', $invoice, $params);
?>
</div>
<?php 
$display = 'none';
if (isset($_GET['debug_invoice'])) {
    $display = "block";
}
?>
<div style="display:<?php 
echo \esc_attr($display);
?>" class="form-wrap inspire-panel">
    <div class="form-field">
        <label for="inspire_invoices_number"><?php 
\esc_html_e('Invoice Number', 'flexible-invoices');
?></label>
        <input type="text" id="inspire_invoices_number" name="number" value="<?php 
echo \esc_attr($invoice->get_number());
?>" />
    </div>

    <div class="form-field">
        <label for="inspire_invoices_formatted_number"><?php 
\esc_html_e('Invoice Formatted Number', 'flexible-invoices');
?></label>
        <input type="text" id="inspire_invoices_formatted_number" name="formatted_number" value="<?php 
echo \esc_attr($invoice->get_formatted_number());
?>" />
    </div>

</div>
<?php 
