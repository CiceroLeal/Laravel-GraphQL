<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use GraphQL;
use App\User;
use App\GraphQL\Types\UserType;

class UserPaginateQuery extends Query
{
    protected $attributes = [
        'name' => 'userPaginate',
        'description' => 'Paginated list of users'
    ];

    public function type(): Type
    {
        return GraphQL::paginate('user');
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
        $paginate = 15;
        if(isset($args['paginate'])){
             $paginate = $args['paginate'];
        }

        $page = 1;
        if(isset($args['page'])){
            $page = $args['page'];
        }

        $fields = $getSelectFields();

        return User
            ::with($fields->getRelations())
            ->paginate($paginate, ['*'], 'page', $page);
    }
}
