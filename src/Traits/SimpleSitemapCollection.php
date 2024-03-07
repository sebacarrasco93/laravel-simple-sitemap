<?php

namespace SebaCarrasco93\SimpleSitemap\Traits;

use SebaCarrasco93\SimpleSitemap\Exceptions\MissingSitemapUrlInsideModel;

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
            'lastUpdate' => $this->updated_at,
            'frequency' => $this->frequency ?? config('simple-sitemap.default_frequency'),
            'priority' => $this->priority ?? config('simple-sitemap.default_priority'),
        ];
    }
}
