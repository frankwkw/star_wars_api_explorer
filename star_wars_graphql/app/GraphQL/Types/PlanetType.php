<?php
/**
 * User: Frank Wong
 * Date: 11/02/2018
 */

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class PlanetType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Planet',
            'description' => 'Star Wars API Planet resource',
            'fields' => function() {
                return [
                    'id' => [
                        'type' => Type::string(),
                        'description' => 'The id of the planet.',
                        'resolve' => function($planet) {
                            // The Star Wars API uses ID's, but these are hidden within the URL.
                            // Therefore extract the trailing identifier from URL to represent ID.
                            return basename($planet->url);
                        },
                    ],
                    'name' => [
                        'type' => Type::string(),
                        'description' => 'The name of the planet.',
                    ],
                ];
            }
        ];
        parent::__construct($config);
    }
}