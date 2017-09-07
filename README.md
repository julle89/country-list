# Country List

Country List is a package for Laravel 4 & 5, which lists all countries with names and ISO 3166-1 codes in all languages and data formats.


## Installation

Add `Tariq86/country-list` to `composer.json`.

    "Tariq86/country-list": "^1.2.0"

Run `composer update` to pull down the latest version of Country List.

Now open up `app/config/app.php` and add the service provider to your `providers` array.

```php
    'providers' => [
        // Other providers...
        Tariq86\CountryList\CountryListServiceProvider::class,
    ]
```

Now add the alias.
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
