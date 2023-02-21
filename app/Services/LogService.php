<?php
namespace App\Services;

use App\Classes\QueryBuilderFilter\Filter;
use App\Classes\QueryBuilderFilter\Log\EndDateFilter;
use App\Classes\QueryBuilderFilter\Log\ServiceNamesFilter;
use App\Classes\QueryBuilderFilter\Log\StartDateFilter;
use App\Classes\QueryBuilderFilter\Log\StatusCodeFilter;
use Illuminate\Database\Eloquent\Builder;


class LogService
{

    /**
     * apply filters to input query
     *
     * @param Builder $query
     * @return Builder
     */
    public function applyFilters(Builder $query): Builder
    {
        $filters = [
            'serviceNames' => ServiceNamesFilter::class,
            'statusCode' => StatusCodeFilter::class,
            'startDate' => StartDateFilter::class,
            'endDate' => EndDateFilter::class,
        ];
        return (new Filter($query))->apply($filters);
    }
}
