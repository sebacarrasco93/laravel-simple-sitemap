<?php

namespace SebaCarrasco93\SimpleSitemap;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use SebaCarrasco93\SimpleSitemap\Generator\Sitemap;
use SebaCarrasco93\SimpleSitemap\Generator\SitemapIndex;
use SebaCarrasco93\SimpleSitemap\Generator\UrlSitemapIndex;

class SimpleSitemap
{
    public function __construct(
        public SitemapIndex $sitemap_index, public Sitemap $sitemap
    )
    {
    }

    public function checkRoutes(array $routes = [])
    {
        if (! count($routes)) {
            throw new Exceptions\EmptyRoutes();
        }
    }

    private function process($instance)
    {
        return response($instance->build())
            ->header('Content-Type', 'text/xml');
    }

    public function index(array $routes = []): Response
    {
        $this->checkRoutes($routes);
        
        foreach ($routes as $route) {
            $this->sitemap_index->add(UrlSitemapIndex::create($route));
        }

        return $this->process($this->sitemap_index);
    }

    public function checkMethod($item, string $method_name)
    {
        if (! method_exists($item, $method_name)) {
            throw new Exceptions\MissingTrait('SimpleSitemapCollection');
        }
    }

    public function fromCollection(Collection $collection)
    {
        $collection->each(function ($item) {
            $this->checkMethod($item, 'getSitemapAttributes');
            
            // dd($item->method_exists('getSitemapAttributes'));
            // dd($item->getSitemapAttributes());
            // dd($item->url);
            $this->sitemap->add(
                $item->getSitemapAttributes()
                // Url::create($item->sitemap_url())
                //     ->lastUpdate($item->updated_at)
                //     ->frequency($item->frequency)
                //     ->priority($item->priority)
            );
        });

        dd($this->sitemap->build());
    }
}
