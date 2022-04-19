<?php

namespace WPDeskFIVendor\WPDesk\Library\Marketing\Boxes;

use WPDeskFIVendor\WPDesk\Library\Marketing\Boxes\Abstracts\BoxInterface;
use WPDeskFIVendor\WPDesk\View\Renderer\Renderer;
/**
 * Renders fields boxes on the submitted data.
 */
class BoxRenderer
{
    /**
     * @var array
     */
    private $boxes;
    /**
     * @var Renderer
     */
    private $renderer;
    /**
     * @var Helpers\BBCodes
     */
    private $bbcodes;
    /**
     * @var Helpers\Markers
     */
    private $markers;
    /**
     * @param array $boxes
     * @param Renderer $renderer
     */
    public function __construct(array $boxes, \WPDeskFIVendor\WPDesk\View\Renderer\Renderer $renderer)
    {
        $this->boxes = $boxes;
        $this->renderer = $renderer;
        $this->init_helpers();
    }
    /**
     * @return void
     */
    protected function init_helpers()
    {
        $this->bbcodes = new \WPDeskFIVendor\WPDesk\Library\Marketing\Boxes\Helpers\BBCodes();
        $this->markers = new \WPDeskFIVendor\WPDesk\Library\Marketing\Boxes\Helpers\Markers();
    }
    /**
     * @return bool
     */
    public function has_boxes() : bool
    {
        return !empty($this->boxes);
    }
    /**
     * @param string $box_id
     *
     * @return bool
     */
    public function has_box(string $box_id) : bool
    {
        return isset($this->boxes[$box_id]);
    }
    /**
     * Get single marketing box.
     *
     * @param string $box_id
     *
     * @return string
     */
    public function get_single(string $box_id) : string
    {
        if ($this->has_box($box_id)) {
            $box = $this->get_box_type($this->boxes[$box_id]);
            return $box->render(['bbcodes' => $this->bbcodes, 'markers' => $this->markers]);
        }
        return '';
    }
    /**
     * Get all marketing boxes (displays all boxes in the layout).
     *
     * @return string
     */
    public function get_all() : string
    {
        return $this->renderer->render('all', ['boxes' => $this->boxes, 'renderer' => $this->renderer, 'plugin' => $this, 'bbcodes' => $this->bbcodes, 'markers' => $this->markers]);
    }
    /**
     * @param array $box
     *
     * @return BoxInterface
     */
    public function get_box_type(array $box) : \WPDeskFIVendor\WPDesk\Library\Marketing\Boxes\Abstracts\BoxInterface
    {
        switch ($box['type']) {
            case 'slider':
                return new \WPDeskFIVendor\WPDesk\Library\Marketing\Boxes\BoxType\SliderBox($box, $this->renderer);
            case 'image':
                return new \WPDeskFIVendor\WPDesk\Library\Marketing\Boxes\BoxType\ImageBox($box, $this->renderer);
            case 'video':
                return new \WPDeskFIVendor\WPDesk\Library\Marketing\Boxes\BoxType\VideoBox($box, $this->renderer);
            case 'simple':
                return new \WPDeskFIVendor\WPDesk\Library\Marketing\Boxes\BoxType\SimpleBox($box, $this->renderer);
            default:
                return new \WPDeskFIVendor\WPDesk\Library\Marketing\Boxes\BoxType\UnknownBox($box, $this->renderer);
        }
    }
}
