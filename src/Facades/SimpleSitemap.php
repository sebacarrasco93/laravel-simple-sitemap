<?php

namespace SebaCarrasco93\SimpleSitemap\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SebaCarrasco93\SimpleSitemap\SimpleSitemap
 */
class SimpleSitemap extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \SebaCarrasco93\SimpleSitemap\SimpleSitemap::class;
    }
}
