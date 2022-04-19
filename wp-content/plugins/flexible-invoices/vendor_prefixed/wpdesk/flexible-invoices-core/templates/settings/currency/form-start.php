<?php

namespace WPDeskFIVendor;

/**
 * @var \WPDesk\Forms\Form\FormWithFields $form
 */
?>
<form class="wrap woocommerce" method="<?php 
echo \esc_attr($form->get_method());
?>" action="<?php 
echo \esc_attr($form->get_action());
?>">
	<h2 style="display:none;"></h2><?php 
// All admin notices will be moved here by WP js
?>

	<table id="flexible_invoices_tax_table" class="form-table flexible_invoices_tax">
		<thead>
		<tr>
			<th class="sort"></th>
			<th class="name">
				<?php 
\esc_html_e('Currency', 'flexible-invoices');
?>
			</th>
			<th class="rate">
				<?php 
\esc_html_e('Currency position', 'flexible-invoices');
?>
			</th>
			<th class="rate">
				<?php 
\esc_html_e('Thousand separator', 'flexible-invoices');
?>
			</th>
			<th class="rate">
				<?php 
\esc_html_e('Decimal separator', 'flexible-invoices');
?>
			</th>
			<th class="delete"></th>
		</tr>
		</thead>

		<tbody class="ui-sortable">
<?php 
