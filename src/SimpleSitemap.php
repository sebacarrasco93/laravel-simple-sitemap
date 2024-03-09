<?php

namespace SebaCarrasco93\SimpleSitemap;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use SebaCarrasco93\SimpleSitemap\Exceptions\EmptyRoutes;
use SebaCarrasco93\SimpleSitemap\Exceptions\MissingTrait;
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
            throw new EmptyRoutes();
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
            throw new MissingTrait('SimpleSitemapCollection');
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

    public function fromMiddleware()
    {
        return collect(Route::getRoutes())->filter(function ($route) {
            return in_array('sitemap', $route->middleware()) &&
                   in_array('GET', $route->methods()) &&
                   count($route->parameterNames()) === 0;
        })->map(function ($route) {
            return url($route->uri());
        });
    }

    public function routes()
    {
        $routes = $this->fromMiddleware();

        $routes->each(function ($item) {
            $this->sitemap->add(
                Url::create($item)
                    ->lastUpdate(config('simple-sitemap.default_last_update'))
                    ->frequency($frequency)
                    ->priority($priority)
            );
        });

        return $this->process($this->sitemap);
    }
}
