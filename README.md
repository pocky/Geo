Geo
===

PHP 5.4+ library to make working with Geo coordinates safer, easier, and fun!

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/e843341b-0a91-4aa8-a8a6-fbe2190d9724/big.png)](https://insight.sensiolabs.com/projects/e843341b-0a91-4aa8-a8a6-fbe2190d9724)
[![Build Status](https://travis-ci.org/black-project/Geo.svg?branch=master)](https://travis-ci.org/black-project/Geo)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/black-project/Geo/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/black-project/Geo/?branch=master)

Installation
------------

The recommended way to install Geo is through [Composer][2]:

```json
{
    "require": {
        "black/geo": "@stable"
    }
}
```

__Protip:__ You should browse the [`black/geo`][7] page to choose a stable version to use, avoid the `@stable` meta
constraint.

Usage
-----

Usage of this class is simple. First, Geo coordinates are based on three values : latitude, longitude and elevation.
Elevation is not required and initialised to 0 if arguments are not provided.

There are three ways to create a Geo object:

```php
$geo = new Geo\Coordinates(37.42242, -122.08585, 0);
$geo->getCoordinates(); // will return "37.42242,-122.08585,0"
```

```php
Geo\Coordinates::fromCoordinatesAsString("37.42242,-122.08585,0")
    ->getLatitude(); // will return "37.42242"
```

```php
Geo\Coordinates::fromCoordinatesAsArray([37.42242, -122.08585, 0])
    ->getCoordinates(); // will return "37.42242,-122.08585,0"
```

__Getter__

List of available getters:

- `getLatitude()`
- `getLongitude()`
- `getElevation()`
- `getCoordinates()`
- `getCoordinatesAsArray()`

__Check if two geo are equals__

- `isEqualTo(Geo $geo)`

__Exception__

If you want to pass 1 or less OR 4 or more arguments, a `Geo\Exception\InvalidCoordinatesException()` will be thrown.

License
-------

Geo is released under the MIT License. See the bundled LICENSE file for details.

Contributing
------------

See CONTRIBUTING file.

Credits
-------

This README is heavily inspired by [Geocoder][1] library by the great [@willdurand][2]. This guy needs your [PR][3] for the
sake of the REST in PHP.

Alexandre "pocky" Balmes [alexandre@lablackroom.com][4]. Send me [Flattrs][5] if you love my work, [buy me gift][6] or hire me!

[1]: https://github.com/geocoder-php/Geocoder
[2]: https://github.com/willdurand
[3]: http://williamdurand.fr/2014/07/02/resting-with-symfony-sos/
[4]: mailto:alexandre@lablackroom.com
[5]: https://flattr.com/profile/alexandre.balmes
[6]: http://www.amazon.fr/registry/wishlist/3OR3EENRA5TSK
[7]: https://packagist.org/packages/black/geo
