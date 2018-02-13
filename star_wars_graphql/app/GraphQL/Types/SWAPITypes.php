<?php
/**
 * User: Frank Wong
 * Date: 11/02/2018
 */

namespace App\GraphQL\Types;

/**
 * SWAPI Types
 *
 * Registry and factory for the SWAPI types.
 *
 * @package SWGraphQL\SWGraphQL
 */
class SWAPITypes
{
    // Object types:
    private static $query;
    private static $person;
    private static $film;
    private static $planet;

    /**
     * @return PersonType
     */
    public static function query()
    {
        return self::$query ?: (self::$query = new QueryType());
    }

    /**
     * @return PersonType
     */
    public static function person()
    {
        return self::$person ?: (self::$person = new PersonType());
    }

    /**
     * @return FilmType
     */
    public static function film()
    {
        return self::$film ?: (self::$film = new FilmType());
    }

    /**
     * @return PlanetType
     */
    public static function planet()
    {
        return self::$planet ?: (self::$planet = new PlanetType());
    }
}