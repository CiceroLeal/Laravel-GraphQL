<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Post;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use GraphQL;

class CreatePostMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createPost',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('post');
    }

    public function args(): array
    {
        return [
            'title' => [
                'name' => 'titulo',
                'type' => Type::nonNull(Type::string()),
            ],
            'active' => [
                'name' => 'ativado',
                'type' => Type::nonNull(Type::boolean()),
            ],
            'user_id' => [
                'name' => 'usuario',
                'type' => Type::nonNull(Type::int()),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $post = Post::create([
            'title' => $args['titulo'],
            'active' => $args['ativado'],
            'user_id' => $args['usuario'],
        ]);

        return $post;
    }
}
