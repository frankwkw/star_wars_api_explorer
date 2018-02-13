<?php
/**
 * User: Frank Wong
 * Date: 11/02/2018
 */

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class FilmType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Film',
            'description' => 'Star Wars API Film resource',
            'fields' => function() {
                return [
                    'id' => [
                        'type' => Type::string(),
                        'description' => 'The id of the film.',
                        'resolve' => function($film) {
                            // The Star Wars API uses ID's, but these are hidden within the URL.
                            // Therefore extract the trailing identifier from URL to represent ID.
                            return basename($film->url);
                        },
                    ],
                    'title' => [
                        'type' => Type::string(),
                    ],
                    'release_date' => [
                        'type' => Type::string(),
                    ],
                ];
            }
        ];
        parent::__construct($config);
    }
}