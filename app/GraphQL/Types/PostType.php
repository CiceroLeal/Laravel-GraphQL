<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;


class PostType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Post',
        'description' => 'Representa um post'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'O id do artigo'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'O titulo do artigo'
            ],
            'active' => [
                'type' => Type::boolean(),
                'description' => 'O status ativado/desativado do artigo'
            ]
        ];
    }
}
