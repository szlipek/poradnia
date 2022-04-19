<?php

namespace WPDeskFIVendor;

require __DIR__ . '/correction-header.php';
require __DIR__ . '/parts/header.php';
require __DIR__ . '/parts/table-with-sum.php';
/**
 * Exchange table
 */
$exchange_table = \WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Helpers\Hooks::template_exchange_vertical_filter($correction, $products, $client);
if (!empty($exchange_table)) {
    ?>
<table class="table-without-margin" style="margin-top: 10px;">
	<tr>
		<td style="width:70%">
			<?php 
    echo $exchange_table;
    ?>
		</td>
		<td style="width:30%; padding-left: 10px;">
			<?php 
    require __DIR__ . '/parts/totals/' . \sanitize_key($correction->get_type()) . '-vertical.php';
    ?>
		</td>
	</tr>
</table>
<?php 
} else {
    require __DIR__ . '/parts/totals/' . \sanitize_key($correction->get_type()) . '-horizontal.php';
}
require __DIR__ . '/parts/signatures.php';
require __DIR__ . '/parts/footer.php';
require __DIR__ . '/correction-footer.php';
