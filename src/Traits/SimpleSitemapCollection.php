<?php

namespace SebaCarrasco93\SimpleSitemap\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use SebaCarrasco93\SimpleSitemap\Exceptions\MissingSitemapUrlInsideModel;
use SebaCarrasco93\SimpleSitemap\Facades\SimpleSitemap;

trait SimpleSitemapCollection
{
    public function checkSitemapAttributes()
    {
        if (! $this->sitemap_url) {
            throw new MissingSitemapUrlInsideModel();
        }
    }

    public function getSitemapAttributes(): array
    {
        $this->checkSitemapAttributes();

        return [
            'url' => $this->sitemap_url,
            'updated_at' => $this->updated_at,
            'frequency' => $this->frequency ?? config('simple-sitemap.default_frequency'),
            'priority' => $this->priority ?? config('simple-sitemap.default_priority'),
        ];
    }

    public function scopeSitemap(Builder $builder): Response
    {
        return SimpleSitemap::fromEloquentCollection($builder->get());
    }
}
