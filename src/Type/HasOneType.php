<?php

namespace Xpromx\GraphQL\Type;

use Xpromx\GraphQL\Definition\Type;
use Xpromx\GraphQL\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL;

class hasOneType extends Query
{
    protected $config = [];

    public function __construct($typeName, $modelMethodName=false, $field=false)
    {
        $method = $modelMethodName;
        
        if (!$modelMethodName) {
            $method = str_slug($typeName);
        }
 
        if (!$field) {
            $field = str_singular($method).'_id';
        }

        $this->config = [
            
            'type' => GraphQL::type($typeName),
            'relation' => true,
            'field' => $field,
            'args' => [],
            'resolve' => function ($root, $args, $context, ResolveInfo $info) use ($method) {
                return $root->$method;
            }
        ];
    }

    public function args()
    {
        return [];
    }
}
