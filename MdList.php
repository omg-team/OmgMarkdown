<?php

namespace OmgMarkdown;

/**
 * Class MdList
 * @package OmgMarkdown
 */
class MdList extends AbstractMdElement
{
    /**
     * @var array
     */
    private $elements = [];

    /**
     * @param array $elements
     */
    public function __construct(array $elements)
    {
        $this->elements = $elements;
    }

    /**
     * @return string
     */
    public function render()
    {
        $list = '';
        foreach ($this->elements as $element) {
            $list .= "<li>{$element}</li>";
        }
        return "<ul>{$list}</ul>";
    }
}