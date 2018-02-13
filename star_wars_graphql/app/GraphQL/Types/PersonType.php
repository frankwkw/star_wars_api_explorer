<?php
/**
 * User: Frank Wong
 * Date: 11/02/2018
 */

namespace App\GraphQL\Types;

use SWAPI\SWAPI;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class PersonType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Person',
            'description' => 'Star Wars API Person resource',
            'fields' => function() {
                return [
                    'id' => [
                        'type' => Type::string(),
                        'description' => 'The id of the person.',
                        'resolve' => function($person) {
                            // The Star Wars API uses ID's, but these are hidden within the URL.
                            // Therefore extract the trailing identifier from URL to represent ID.
                            return basename($person->url);
                        },
                    ],
                    'name' => [
                        'type' => Type::string(),
                    ],
                    'birth_year' => [
                        'type' => Type::string(),
                    ],
                    'eye_color' => [
                        'type' => Type::string(),
                    ],
                    'gender' => [
                        'type' => Type::string(),
                    ],
                    'hair_color' => [
                        'type' => Type::string(),
                    ],
                    'height' => [
                        'type' => Type::int(),
                    ],
                    'mass' => [
                        'type' => Type::int(),
                    ],
                    'skin_color' => [
                        'type' => Type::string(),
                    ],
                    'homeworld' => [
                        'type' => SWAPITypes::planet(),
                        'resolve' => function($person) {
                            if (isset($person->homeworld) === false) {
                                return null;
                            }

                            $swapi = new SWAPI;

                            $id = basename($person->homeworld->url);

                            return $swapi->planets()->get($id);
                        }
                    ],
                    'films' => [
                        'type' => Type::listOf(SWAPITypes::film()),
                        'resolve' => function($person) {
                            if (empty($person->films) === true) {
                                return [];
                            }

                            $swapi = new SWAPI;

                            $films = $swapi->films()->index();

                            foreach ($person->films as $personFilm) {
                                foreach ($films as $film) {
                                    if (strcmp($personFilm->url, $film->url) === 0) {
                                        $result[] = $film;
                                    }
                                }
                            }

                            return $result;
                        }
                    ],
                ];
            }
        ];
        parent::__construct($config);
    }
}