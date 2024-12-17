<?php

namespace App\Utils;

use Illuminate\Pagination\LengthAwarePaginator;

class CustomPaginator extends LengthAwarePaginator
{
    public function __construct($items, $total, $perPage, $currentPage = null, array $options = [])
    {
        parent::__construct($items, $total, $perPage, $currentPage, $options);

        // Automatically set available_filters
        $this->available_filters = $this->resolveAvailableFilters();
    }

    protected function resolveAvailableFilters()
    {
        $model = $this->first();
        if (is_object($model) && method_exists($model, 'getAvailableFilters')) {
            return $model->getAvailableFilters();
        } else {
            return [];
        }
    }

    public function toArray()
    {
        $data = parent::toArray();
        $data['available_filters'] = $this->available_filters;
        return $data;
    }
}
