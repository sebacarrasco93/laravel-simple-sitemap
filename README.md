# Laravel Simple Sitemap

A very simple package: Create sitemaps "on the fly"

## Installation

You can install the package via composer:

```bash
composer require sebacarrasco93/laravel-simple-sitemap
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="simple-sitemap-config"
```

This is the contents of the published config file:

```php
return [    

    'default_frequency' => 'monthly',
    
    'default_priority' => '0.50',
];
```

## Usage

Create a sitemap for Eloquent Collections

Let's assume that you want to make a sitemap of all the categories, you can do that in only 3 steps!

```php
// app/Models/Category

use SebaCarrasco93\SimpleSitemap\Traits\SimpleSitemapCollection; // 👈 1: Import Trait

class Category extends Model
{
    use HasFactory;
    // ...
    use SimpleSitemapCollection; // 👈 2: Use the trait

    // ...

    // 👇 Step 3: Create getSitemapUrlAttribute() method and specify the full url
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

return SimpleSitemap::fromEloquentCollection($categories);
```

Can I short the syntax? Of course!

```php
return Category::sitemap(); // Equivalent to SimpleSitemap::fromEloquentCollection(Category::get());
```

### Advanced usage

A sitemap for only active categories? Sure!

```php
return Category::where('active', true)
    ->sitemap();
```

A sitemap for active, and only 10 last categories? It's Eloquent and Laravel!

```php
$active_categories = Category::where('active', true)
    ->orderBy('desc', 'id')->take(10)->get();

return SimpleSitemap::fromCollection($active_categories);
```

Easy Peasy!

Optionally, you can create a index sitemap with your sitemap collections

```php
$routes = [
    route('sitemaps/index-1'), // You can pass it as a route
    'https://yourdomain.com/sitemaps/index-2', // or, as full path
    '/sitemaps/index-3', // as a relative path, too
];

return SimpleSitemap::index($routes);
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
