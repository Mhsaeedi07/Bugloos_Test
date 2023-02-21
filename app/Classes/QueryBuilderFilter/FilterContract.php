<?php


namespace App\Classes\QueryBuilderFilter;


use Illuminate\Database\Eloquent\Builder;

abstract class FilterContract
{

    /**
     * @var Builder
     */
    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    /**
     * apply filter to query
     *
     * @param null $value
     * @return Builder
     */
    abstract public function applyFilter($value = null): Builder;
}