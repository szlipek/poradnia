<?php

namespace WPDeskFIVendor;

/**
 * @var \WPDesk\Forms\Field            $field
 * @var \WPDesk\View\Renderer\Renderer $renderer
 * @var string                         $name_prefix
 * @var array                          $value
 * @var string                         $template_name Real field template.
 */
use WPDeskFIVendor\WPDesk\Forms\Field\SelectField;
use WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Configs\Currency;
if (!$value) {
    $value = $field->get_empty_values();
}
$value = \array_values($value);
for ($i = 0; $i < \count($value); $i++) {
    echo '<tr><td class="sort"><input type="hidden" class="row-num" value="' . $i . '" /></td>';
    $items = $field->get_items();
    $currency_slug = $value[$i]['currency'];
    if (\is_array($items)) {
        foreach ($items as $item) {
            if ($item->get_name() === 'currency_position' && $item instanceof \WPDeskFIVendor\WPDesk\Forms\Field\SelectField) {
                $item->set_options(\WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Configs\Currency::get_currency_position_options($currency_slug));
            }
            ?>
			<td class="forminp">
				<?php 
            $val = isset($value[$i][$item->get_name()]) ? (string) \esc_attr($value[$i][$item->get_name()]) : '';
            echo $renderer->render($item->get_template_name(), ['field' => $item, 'renderer' => $renderer, 'name_prefix' => $name_prefix . '[' . $field->get_name() . '][' . $i . ']', 'value' => $val, 'multiple' => $field->is_multiple()]);
            ?>
			</td>
			<?php 
        }
        echo '<td class="delete"><a href="#" class="delete-item"><span class="dashicons dashicons-no-alt"></span></a></td></tr>';
    }
    ?>

<?php 
}
