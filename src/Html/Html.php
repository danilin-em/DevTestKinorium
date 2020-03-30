<?php

namespace Html;

use SelectBox\SelectBox;
use SelectBox\SelectBoxOptions;
use SelectBox\SelectBoxAttributes;

class Html
{
    // TODO: Extend wrapper another tags
    public static function select(array $options = [], array $attributes = []): SelectBox
    {
        return new SelectBox(new SelectBoxOptions($options), new SelectBoxAttributes($attributes));
    }
}