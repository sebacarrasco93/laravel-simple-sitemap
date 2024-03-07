<?php

namespace SebaCarrasco93\SimpleSitemap\Exceptions;

class MissingTrait extends \Exception
{
    public function __construct($name)
    {
        $this->message = "Please add the {$name} trait into your model";
    }
}
