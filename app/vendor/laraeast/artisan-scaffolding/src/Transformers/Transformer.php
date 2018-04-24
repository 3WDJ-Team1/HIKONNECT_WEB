<?php

namespace Laraeast\Artisan\Scaffolding\Transformers;

use Illuminate\Pagination\LengthAwarePaginator;

abstract class Transformer
{
    /**
     * Transform a collection of items.
     *
     * @param \Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\LengthAwarePaginator $items
     * @param string $method
     * @return array|\Illuminate\Pagination\LengthAwarePaginator
     */
    public function collection($items, $method = 'model')
    {
        $collection = $items instanceof LengthAwarePaginator ? $items->getCollection() : $items;

        $collection->transform(function ($item) use ($method) {
            return $this->{$method}($item);
        });

        return $items;
    }

    /**
     * Transform a model instance.
     *
     * @param $item
     * @return array
     */
    abstract public function model($model);
}
