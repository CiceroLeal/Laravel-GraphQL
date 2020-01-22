<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use GraphQL;
use App\GraphQL\Types\UserType;

class UserQuery extends Query
{
    protected $attributes = [
        'name' => 'user',
        'description' => 'List of users'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('user'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'O id do usuário no banco'
            ],
            'paginate' => [
                'type' => Type::int(),
                'description' => 'Quantidade de registros'
            ],
            'page' => [
                'type' => Type::int(),
                'description' => 'página de registro'
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if(isset($args['id'])){
            return User::where('id', $args['id'])->get();
        }

        if(isset($args['paginate'])){
            $page = 1;

            if(isset($args['page'])){
                $page = $args['page'];
            }
            return User::paginate($args['paginate'], ['*'], 'page', $page);
        }

        return User::all();
    }
}
