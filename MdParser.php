<?php

namespace OmgMarkdown;

/**
 * Class MdParser
 * @package OmgMarkdown
 */
class MdParser
{

    /**
     * @var string
     */
    private $raw_text;

    /** @var AbstractMdElement[] */
    private $elements_array = [];

    /**
     * @param $text
     * @return static
     */
    public static function create($text)
    {
        $parser = new static();
        $parser->setRowText($text);
        return $parser;
    }

    /**
     * @param $text
     * @return mixed
     */
    public function setRowText($text)
    {
        $this->raw_text = $text;
        return $text;
    }

    /**
     *
     */
    public function parse()
    {
        $string_array = explode("\n", $this->raw_text);

        $blocs = [];

        $block_num = 1;

        foreach ($string_array as $string) {

            $string = trim($string);

            if (empty($string)) {
                if (!empty($blocs[$block_num])) {
                    ++$block_num;
                }
                continue;
            } else {
                $blocs[$block_num][] = $string;
            }

        }

        foreach ($blocs as $block) {

            if ($element = $this->isTitle($block)) {
                $this->elements_array[] = $element;
                continue;
            }

            if ($element = $this->isList($block)) {
                $this->elements_array[] = $element;
                continue;
            }

            $this->elements_array[] = new MdParagraph($block);
        }
    }

    /**
     * @return string
     */
    public function render()
    {
        $html = '';
        foreach ($this->elements_array as $element) {
            $html .= $element->render();
        }
        return $html;
    }

    /**
     * @param array $block
     * @return MdList|null
     */
    protected function isList(array $block)
    {
        $list_elements = [];
        foreach ($block as $string) {

            if ($element = $this->isStartStringBy($string, '* ')) {
                $list_elements[] = $element;
                continue;
            }

            if ($element = $this->isStartStringBy($string, '+ ')) {
                $list_elements[] = $element;
                continue;
            }

            if ($element = $this->isStartStringBy($string, '- ')) {
                $list_elements[] = $element;
                continue;
            }

            return null;
        }
        return new MdList($list_elements);
    }

    /**
     * @param array $block
     * @return MdTitle|null
     */
    protected function isTitle(array $block)
    {
        if (
            count($block) == 1 && $block[0][0] == '#'
        ) {
            $text = trim($block[0], "# \t\n\r\0\x0B");
            for ($i=1; $i<5; $i++) {
                if ($block[0][$i] != '#') {
                    return new MdTitle($text, $i);
                }
            }
            return new MdTitle($text, 5);
        }

        if (count($block) == 2) {
            if ($this->isStringChar($block[1], '-')) {
                return new MdTitle($block[0], 2);
            }
            if ($this->isStringChar($block[1], '=')) {
                return new MdTitle($block[0], 1);
            }
        }

        return null;
    }

    /**
     * @param $string
     * @param $start_string
     * @return null|string
     */
    protected function isStartStringBy($string, $start_string)
    {
        $start_string_length = strlen($start_string);
        if (substr($string, 0, $start_string_length) == $start_string) {
            return substr($string, $start_string_length);
        }
        return null;
    }

    /**
     * @param $string
     * @param $char
     * @return bool
     */
    protected function isStringChar($string, $char)
    {
        for ($i = 0; $i < strlen($string); $i++) {
            if ($string[$i] !== $char) {
                return false;
            }
        }
        return true;
    }
}