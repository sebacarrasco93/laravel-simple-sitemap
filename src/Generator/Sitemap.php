<?php

namespace SebaCarrasco93\SimpleSitemap\Generator;

class Sitemap
{
    public const START_TAG = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    public const END_TAG = '</urlset>';

    private $content;

    public function add(Url $sitemapUrl)
    {
        $this->content .= $sitemapUrl->build();
    }

    public function build()
    {
        return self::START_TAG.$this->content.self::END_TAG;
    }
}
