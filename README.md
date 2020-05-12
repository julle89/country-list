# Country List

[![Build Status](https://travis-ci.org/tariq86/country-list.svg?branch=master)](https://travis-ci.org/tariq86/country-list)
[![codecov](https://codecov.io/gh/tariq86/country-list/branch/master/graph/badge.svg)](https://codecov.io/gh/tariq86/country-list)

Country List is a package for Laravel 5+, which lists all countries with names and ISO 3166-1 codes in all languages and data formats.

## Installation

Require package via Composer: `composer require tariq86/country-list`

As of version 2.0.0 of this package, Laravel 5.8 is the minimum required version, so you do not need to perform any further actions.
If you are using an older version of Laravel, you will also need to use an older version of this package (i.e. 1.3.1).

## Usage

- Locale (en, en_US, fr, fr_CA...)
  - If no locale is given (or if it is set to null), then it will default to 'en'
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
