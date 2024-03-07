<?php

namespace SebaCarrasco93\SimpleSitemap\Exceptions;

class EmptyRoutes extends \Exception
{
    public $message = 'Please provide at least one route';
}
