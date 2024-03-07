<?php

namespace SebaCarrasco93\SimpleSitemap\Exceptions;

class MissingSitemapAttributesInsideModel extends \Exception
{
    public $message = 'Please specify your getSitemapAttributes() into your model';
}
