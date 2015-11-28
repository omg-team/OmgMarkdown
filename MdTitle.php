<?php

namespace OmgMarkdown;

/**
 * Class MdTitle
 * @package OmgMarkdown
 */
class MdTitle extends AbstractMdElement
{
    /**
     * @var string
     */
    private $string = '';

    /**
     * @var int
     */
    private $level = 0;

    /**
     * @var array
     */
    private $tag = [
        1 => 'h1',
        2 => 'h2',
        3 => 'h3',
        4 => 'h4',
        5 => 'h5',
    ];

    /**
     * @param $string
     * @param $level
     */
    public function __construct($string, $level)
    {
        $this->string = $string;
        $this->level = $level;
    }

    /**
     * @param $level
     * @return array
     */
    protected function getTag($level)
    {
        if (isset($this->tag[$level])) {
            $tag = $this->tag[$level];
            return ["<{$tag}>", "</{$tag}>"];
        }
        return ["<h1>", "</h1>"];
    }

    /**
     * @return string
     */
    public function render()
    {
        list($t1, $t2) = $this->getTag($this->level);
        return "{$t1}{$this->string}{$t2}";
    }
}