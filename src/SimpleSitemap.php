<?php

namespace SebaCarrasco93\SimpleSitemap;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use SebaCarrasco93\SimpleSitemap\Generator\Sitemap;
use SebaCarrasco93\SimpleSitemap\Generator\SitemapIndex;
use SebaCarrasco93\SimpleSitemap\Generator\Url;
use SebaCarrasco93\SimpleSitemap\Generator\UrlSitemapIndex;

class SimpleSitemap
{
    public function __construct(
        public SitemapIndex $sitemap_index, public Sitemap $sitemap
    ) {
    }

    public function checkRoutes(array $routes = []): void
    {
        if (! count($routes)) {
            throw new Exceptions\EmptyRoutes();
        }
    }

    private function process($instance): Response
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

    public function checkMethod($item, string $method_name): void
    {
        if (! method_exists($item, $method_name)) {
            throw new Exceptions\MissingTrait('SimpleSitemapCollection');
        }
    }

    public function fromEloquentCollection(Collection $collection): Response
    {
        $collection->each(function ($item) {
            $this->checkMethod($item, 'getSitemapAttributes');

            extract($item->getSitemapAttributes());

            $this->sitemap->add(
                Url::create($url)
                    ->lastUpdate($updated_at)
                    ->frequency($frequency)
                    ->priority($priority)
            );
        });

        return $this->process($this->sitemap);
    }
}
