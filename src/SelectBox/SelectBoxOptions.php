<?php

namespace SelectBox;

class SelectBoxOptions implements \Iterator
{
    private $options;
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }
    public function rewind(): void
    {
        reset($this->options);
    }
    public function current(): string
    {
        return current($this->options);
    }
    public function key(): string
    {
        $key = key($this->options);
        if (is_numeric($key)) {
            $key = $this->options[$key];
        }
        return $key;
    }
    public function next(): void
    {
        next($this->options);
    }
    public function valid(): bool
    {
        return key($this->options) !== null;
    }
}
