<?php

namespace SebaCarrasco93\SimpleSitemap;

use Illuminate\Http\Response;
use SebaCarrasco93\SimpleSitemap\Generator\SitemapIndex;
use SebaCarrasco93\SimpleSitemap\Generator\UrlSitemapIndex;

class SimpleSitemap
{
    public function __construct(public SitemapIndex $sitemap_index)
    {
    }

    public function checkRoutes(array $routes = [])
    {
        if (! count($routes)) {
            throw new Exceptions\EmptyRoutes();
        }
    }

    public function index(array $routes = []): Response
    {
        $this->checkRoutes($routes);
        
        foreach ($routes as $route) {
            $this->sitemap_index->add(UrlSitemapIndex::create($route));
        }

        return response($this->sitemap_index->build())
            ->header('Content-Type', 'text/xml');
    }
}
