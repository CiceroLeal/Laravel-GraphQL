<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\User;
use GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A type for Users',
        'model' => User::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'O id do usuário no banco'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'O nome do usuário no banco'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'O email do usuário no banco'
            ],
            'posts' => [
                'type' => Type::listOf(GraphQL::type('post')),
                'description' => 'Lista de artigos por usuário',
                'query' => function (array $args, $query){
                    return $query->where('posts.active', true);
                }
            ]
        ];
    }
}
