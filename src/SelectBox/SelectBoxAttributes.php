<?php

namespace SelectBox;

class SelectBoxAttributes
{
    // TODO: List of Allowed Attributes
    // TODO: Extending by HTML Global Attributes
    private $attr_tpl = ' %s="%s"';
    private $attributes;
    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }
    public function __toString()
    {
        $attrs = '';
        foreach ($this->attributes as $key => $value) {
            $attrs .= sprintf($this->attr_tpl, $key, $value);
        }
        return $attrs;
    }
}

