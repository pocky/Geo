<?php

/*
 * This file is part of the Geo package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Geo;

use Geo\Geo as GeoClass;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class GeoSpec
 *
 * @author Alexandre Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class GeoSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Geo\Geo');
    }

    function let()
    {
        $this->beConstructedWith(37.42242, -122.08585);
    }

    function it_should_return_latitude()
    {
        $this->getLatitude()->shouldReturn("37.42242");
    }

    function it_should_return_longitude()
    {
        $this->getLongitude()->shouldReturn("-122.08585");
    }

    function it_should_return_elevation()
    {
        $this->getElevation()->shouldReturn("0");
    }

    function it_should_return_coordinates_as_string()
    {
        $this->getCoordinates()->shouldBeString();
    }

    function it_should_return_coordinates_as_array()
    {
        $this->getCoordinatesAsArray()->shouldBeArray();
    }

    function it_should_be_equal()
    {
        $geo = new GeoClass(37.42242, -122.08585);
        $this->isEqualTo($geo)->shouldReturn(true);
    }

    function it_should_create_a_geo_from_string()
    {
        $this::fromCoordinatesAsString("38.42242,-122.08585")
            ->getLatitude()
            ->shouldReturn("38.42242");

        $this::fromCoordinatesAsString("38.42242,-122.08585,20")
            ->getElevation()
            ->shouldReturn("20");
    }

    function it_should_create_a_geo_from_array()
    {
        $this::fromCoordinatesAsArray([38.42242, -123.08585])
            ->getLongitude()
            ->shouldReturn("-123.08585");

        $this::fromCoordinatesAsArray([38.42242, -123.08585, 10])
            ->getElevation()
            ->shouldReturn("10");
    }

    function it_should_throw_an_exception_because_of_too_many_arguments()
    {
        $this
            ->shouldThrow('Geo\Exception\InvalidCoordinatesException')
            ->during('fromCoordinatesAsArray', [[38.42242, -123.08585, 10, 20]]);

        $this
            ->shouldThrow('Geo\Exception\InvalidCoordinatesException')
            ->during('fromCoordinatesAsString', [38.42242, -123.08585, 10, 20]);

        $this
            ->shouldThrow('Geo\Exception\InvalidCoordinatesException')
            ->during('fromCoordinatesAsString', ["38.42242"]);
    }

    function it_should_throw_an_exception_because_of_not_much_arguments()
    {
        $this
            ->shouldThrow('Geo\Exception\InvalidCoordinatesException')
            ->during('fromCoordinatesAsArray', [[38.42242]]);

        $this
            ->shouldThrow('Geo\Exception\InvalidCoordinatesException')
            ->during('fromCoordinatesAsString', ["38.42242"]);
    }
}
