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
                        'description' => 'The name of the person.',
                    ],
                    'birth_year' => [
                        'type' => Type::string(),
                        'description' => 'The year the person was born.',
                    ],
                    'eye_color' => [
                        'type' => Type::string(),
                        'description' => 'The eye color of the person.',
                    ],
                    'gender' => [
                        'type' => Type::string(),
                        'description' => 'The gender of the person.',
                    ],
                    'hair_color' => [
                        'type' => Type::string(),
                        'description' => 'The hair color of the person.',
                    ],
                    'height' => [
                        'type' => Type::int(),
                        'description' => 'The height of the person.',
                    ],
                    'mass' => [
                        'type' => Type::int(),
                        'description' => 'The mass of the person.',
                    ],
                    'skin_color' => [
                        'type' => Type::string(),
                        'description' => 'The skin color of the person.',
                    ],
                    'homeworld' => [
                        'type' => SWAPITypes::planet(),
                        'description' => 'The homeworld of the person.',
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
                        'description' => 'Films that featured the person.',
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