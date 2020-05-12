# Country List

Country List is a package for Laravel 5+, which lists all countries with names and ISO 3166-1 codes in all languages and data formats.

## Installation

Require package via Composer: `composer require tariq86/country-list`

Laravel 5.5 uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider. If you don't use
auto-discovery (i.e. if running Laravel <= 5.4), add the ServiceProvider to the `providers` array in `config/app.php`:

```php
    'providers' => [
        // Other providers...
        Tariq86\CountryList\CountryListServiceProvider::class,
    ]
```

If needed, add the following alias as well.

```php
    'aliases' => [
        // Other aliases...
        'Countries' => Tariq86\CountryList\CountryListFacade::class
    ]
```

## Usage

- Locale (en, en_US, fr, fr_CA...)
  - If no locale is given (or if it is set to null), then the current Laravel app's locale will be used (via `\App::getLocale()`)
- Format (csv, flags.html, html, json, mysql.sql, php, postgresql.sql, sqlite.sql, sqlserver.sql, txt, xml, yaml)

Get all countries
```php
Route::get('/', function()
{
    return Countries::getList('en', 'json');
});
```

Get one country
```php
Route::get('/', function()
{
    return Countries::getOne('RU', 'en');
});
```
