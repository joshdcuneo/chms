<?php

namespace App\GraphQL\Resolvers;

use ArrayAccess;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Str;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class DefaultResolver
{
    public function __invoke(mixed $parent, $args, GraphQLContext $context, ResolveInfo $resolveInfo): mixed
    {
        $fieldName = $resolveInfo->fieldName;
        $snakeFieldName = Str::snake($fieldName);

        $value = $this->getFieldValue($parent, $fieldName);

        if ($value === null && $snakeFieldName !== $fieldName) {
            // Give a chance to resolve field using the snake case
            $value = $this->getFieldValue($parent, $snakeFieldName);
        }

        return $value instanceof Closure ? $value($parent, $args, $context, $resolveInfo) : $value;
    }

    protected function getFieldValue(mixed $parent, string $fieldName): mixed
    {
        if (is_array($parent) || $parent instanceof ArrayAccess) {
            return $parent[$fieldName] ?? null;
        }
        if (is_object($parent) && isset($parent->{$fieldName})) {
            return $parent->{$fieldName};
        }

        return null;
    }
}
