<?php

/*
 * This file is part of the Geo package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Geo;

use Geo\Exception\InvalidCoordinatesException;

/**
 * Class Coordinates
 * The geographic coordinates of a place, address or event.
 *
 * @author Alexandre Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class Coordinates
{
    /**
     * @var string  The latitude of a location. For example 37.42242.
     */
    private $latitude;

    /**
     * @var string  The longitude of a location. For example -122.08585.
     */
    private $longitude;

    /**
     * @var string  The elevation of a location.
     */
    private $elevation;

    /**
     * @param float $latitude
     * @param float $longitude
     * @param int   $elevation
     */
    public function __construct($latitude, $longitude, $elevation = 0)
    {
        $this->latitude  = (string) $latitude;
        $this->longitude = (string) $longitude;
        $this->elevation = (string) $elevation;
    }

    /**
     * @param  string      $coordinates
     * @param  string      $delimiter
     * @return Coordinates
     */
    public static function fromCoordinatesAsString($coordinates, $delimiter = ",")
    {
        if (!is_string($coordinates)) {
            throw new InvalidCoordinatesException("Argument coordinates must be a string");
        }

        $geoArray = explode($delimiter, $coordinates, 3);
        $geoCount = count($geoArray);

        if (2 == $geoCount) {
            $geoArray[] = 0;
        }

        if ($number = $geoCount < 2) {
            throw new InvalidCoordinatesException(sprintf("We need 3 or less coordinates! %s given", $number));
        }

        list($latitude, $longitude, $elevation) = $geoArray;

        return new self($latitude, $longitude, $elevation);
    }

    /**
     * @param  array       $coordinates
     * @return Coordinates
     */
    public static function fromCoordinatesAsArray(array $coordinates)
    {
        $number = count($coordinates);

        if ($number < 2 || $number > 3) {
            throw new InvalidCoordinatesException(sprintf("We need 3 or less coordinates! %s given", $number));
        }

        if (2 == $number) {
            $coordinates[] = "0";
        }

        return new self($coordinates[0], $coordinates[1], $coordinates[2]);
    }

    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @return int
     */
    public function getElevation()
    {
        return $this->elevation;
    }

    /**
     * @return string
     */
    public function getCoordinates()
    {
        return sprintf("%s,%s,%s", $this->latitude, $this->longitude, $this->elevation);
    }

    /**
     * @return array
     */
    public function getCoordinatesAsArray()
    {
        return [$this->latitude, $this->longitude, $this->elevation];
    }

    /**
     * @param  Coordinates $coordinates
     * @return bool
     */
    public function isEqualTo(Coordinates $coordinates)
    {
        return $this->getCoordinates() === $coordinates->getCoordinates();
    }
}
