<?php

namespace OmgMarkdown;

/**
 * Class MdParagraph
 * @package OmgMarkdown
 */
class MdParagraph extends AbstractMdElement
{
    /**
     * @var string
     */
    private $text = '';

    /**
     * @param array $block
     */
    public function __construct(array $block)
    {
        $text = join(' ', $block);
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function render()
    {
        return "<p>{$this->text}</p>";
    }
}