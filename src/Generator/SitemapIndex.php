<?php

namespace SebaCarrasco93\SimpleSitemap\Generator;

class SitemapIndex
{
    public const HEADER_TAG = '<?xml version="1.0" encoding="UTF-8"?>';

    public const START_TAG = '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    public const END_TAG = '</sitemapindex>';

    private $content;

    public function add(UrlSitemapIndex $sitemapUrl)
    {
        $this->content .= $sitemapUrl->build();
    }

    public function build()
    {
        return self::HEADER_TAG.self::START_TAG.$this->content.self::END_TAG;
    }
}
