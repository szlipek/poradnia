<?php

namespace WPDeskFIVendor\WPDesk\Library\FlexibleInvoicesCore\Settings\Fields;

use WPDeskFIVendor\WPDesk\Forms\Field;
/**
 * Disable field adapter.
 *
 * @package WPDesk\FIT\Settings\Fields
 */
class DisableFieldProAdapter
{
    /**
     * @var Field\BasicField
     */
    private $field;
    /**
     * @var string
     */
    private $name;
    /**
     * @param Field $field
     */
    public function __construct(string $name, \WPDeskFIVendor\WPDesk\Forms\Field $field)
    {
        $this->name = $name;
        $this->field = $field;
    }
    public function should_disable($disable = \false)
    {
        if ($disable) {
            $this->field->set_disabled();
            return $this->field;
        }
        $this->field->set_name($this->name);
        return $this->field;
    }
}
