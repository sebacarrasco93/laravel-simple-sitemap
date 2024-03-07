<?php

namespace SebaCarrasco93\SimpleSitemap\Exceptions;

class MissingSitemapUrlInsideModel extends \Exception
{
    public $message = 'Please specify your sitemap_url inside getSitemapAttributes() into your model';
}
