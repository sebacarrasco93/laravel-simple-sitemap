<?php

namespace SebaCarrasco93\SimpleSitemap\Generator;

class UrlSitemapIndex
{
    private $url;

    public static function create($url)
    {
        $newNode = new self();
        $newNode->url = url($url);

        return $newNode;
    }

    public function build()
    {
        return '<sitemap>'.
        "<loc>{$this->url}</loc>".
        '</sitemap>';
    }
}
