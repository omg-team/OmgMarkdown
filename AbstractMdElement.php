<?php

namespace OmgMarkdown;

/**
 * Class AbstractMdElement
 * @package OmgMarkdown
 */
abstract class AbstractMdElement
{
    protected $element_class = '';

    /**
     * @param $class_name
     * @return $this
     */
    public function setElementClass($class_name)
    {
        $this->element_class = $class_name;
        return $this;
    }

    /**
     * @return mixed
     */
    abstract public function render();

    /**
     * @return mixed
     */
    function __toString()
    {
        return $this->render();
    }
}