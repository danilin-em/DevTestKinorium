<?php

namespace SelectBox;

class SelectBox
{
    // TODO: Extend by Another Tags (Example: <label>)
    private $options;
    private $attributes;
    public function __construct(SelectBoxOptions $options, SelectBoxAttributes $attributes)
    {
        $this->options = $options;
        $this->attributes = $attributes;
    }
    public function html(): string
    {
        $html = $this->openTag();
        foreach ($this->options as $value => $text) {
            $html .= $this->optionTag($value, $text);
        }
        $html .= $this->closeTag();
        return $html;
    }
    public function __toString(): string
    {
        return $this->html();
    }
    private function openTag():string
    {
        return sprintf('<select%s>', $this->attributes);
    }
    private function closeTag():string
    {
        return '</select>';
    }
    private function optionTag(string $value, string $text): string
    {
        return sprintf('<option value="%s">%s</option>', $value, $text);
    }
}
