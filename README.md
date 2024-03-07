# Laravel Simple Sitemap

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sebacarrasco93/laravel-simple-sitemap.svg?style=flat-square)](https://packagist.org/packages/sebacarrasco93/laravel-simple-sitemap)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/sebacarrasco93/laravel-simple-sitemap/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/sebacarrasco93/laravel-simple-sitemap/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/sebacarrasco93/laravel-simple-sitemap/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/sebacarrasco93/laravel-simple-sitemap/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/sebacarrasco93/laravel-simple-sitemap.svg?style=flat-square)](https://packagist.org/packages/sebacarrasco93/laravel-simple-sitemap)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-simple-sitemap.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-simple-sitemap)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require sebacarrasco93/laravel-simple-sitemap
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-simple-sitemap-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-simple-sitemap-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-simple-sitemap-views"
```

## Usage

Create a sitemap for Eloquent Collections

Let's assume that you want to make a sitemap of all the categories, you can do that in only 3 steps!

```php
// app/Models/Category

class Category extends Model
{
    use HasFactory;
    // ...
    use \SebaCarrasco93\SimpleSitemap\Traits\SimpleSitemapCollection; // 👈 Step 1: Import Trait

    // ...

    // 👇 Step 2: Create getSitemapUrlAttribute() method and specify the full url
    public function getSitemapUrlAttribute(): string 
    {
        return route('category.show', $this);
    }
}

```

Now, you can use it

```php
// web.php, controller or equivalent

$categories = Category::get();

return SimpleSitemap::fromCollection($categories);
```

Easy Peasy!

Now, you can create a index sitemap

```php
$routes = [
    route('sitemaps/index-1'), // You can pass it as a route
    'https://yourdomain.com/sitemaps/index-2', // or, as full path
    '/sitemaps/index-3', // as a relative path, too
];

return SimpleSitemap::index($routes);
```

### Advanced use

Can I short the syntax? Of course!

```php
return SimpleSitemap::collect(Category::get());
```

A sitemap for only active categories? Sure!

```php
$active_categories = Category::where('active', true)->get();

return SimpleSitemap::collect($active_categories);
```

A sitemap for active, and only 10 last categories? It's Eloquent and Laravel!

```php
$active_categories = Category::where('active', true)
    ->orderBy('desc', 'id')->take(10)->get();

return SimpleSitemap::collect($active_categories);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Seba Carrasco Poblete](https://github.com/sebacarrasco93)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
