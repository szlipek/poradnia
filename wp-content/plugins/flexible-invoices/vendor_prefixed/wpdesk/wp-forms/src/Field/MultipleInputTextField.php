<?php

namespace WPDeskFIVendor\WPDesk\Forms\Field;

class MultipleInputTextField extends \WPDeskFIVendor\WPDesk\Forms\Field\InputTextField
{
    /**
     * @return string
     */
    public function get_template_name()
    {
        return 'input-text-multiple';
    }
}
