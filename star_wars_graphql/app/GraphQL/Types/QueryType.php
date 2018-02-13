<?php
/**
 * User: Frank Wong
 * Date: 11/02/2018
 */

namespace App\GraphQL\Types;

use SWAPI\SWAPI;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class QueryType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Query',
            'description' => 'Star Wars API Query',
            'fields' => function() {
                return [
                    // Search people
                    'allPeople' => [
                        'type' => Type::listOf(SWAPITypes::person()),
                        'resolve' => function() {
                            $swapi = new SWAPI;

                            return $swapi->characters()->index();
                        }
                    ],
                    // Retrieve person by ID
                    'person' => [
                        'type' => SWAPITypes::person(),
                        'args' => [
                            'id' => Type::int()
                        ],
                        'resolve' => function($root, $args) {
                            $swapi = new SWAPI;

                            if (isset($args['id'])) {
                                $id = $args['id'];
                            } else {
                                $id = 1;
                            }

                            return $swapi->characters()->get($id);
                        },

                    ],
                ];
            }
        ];
        parent::__construct($config);
    }
}