<?php

namespace Nuwave\Lighthouse\Support\Traits;

use Nuwave\Lighthouse\Support\Traits\GlobalIdTrait;

trait RelayConnection
{
    use GlobalIdTrait;

    /**
     * Paginate connection w/ query args.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  array  $args
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetConnection($query, array $args)
    {
        $first = isset($args['first']) ? $args['first'] : 15;
        $after = $this->decodeCursor($args);
        $page = isset($args['page']) ? $args['page'] : 1;
        $currentPage = $first && $after ? floor(($first + $after) / $first) : $page;

        return $query->paginate($first, ['*'], 'page', $currentPage);
    }
}