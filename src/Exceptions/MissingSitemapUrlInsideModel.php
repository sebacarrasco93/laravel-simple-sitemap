<?php

namespace SebaCarrasco93\SimpleSitemap\Exceptions;

class MissingSitemapUrlInsideModel extends \Exception
{
    public $message = 'Please specify your getSitemapUrlAttribute() into your model';
}
