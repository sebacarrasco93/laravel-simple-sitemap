<?php

namespace SebaCarrasco93\SimpleSitemap;

use Closure;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SimpleSitemapServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-simple-sitemap')
            ->hasConfigFile('simple-sitemap');
    }
}
