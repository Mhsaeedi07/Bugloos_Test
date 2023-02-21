<?php


namespace App\Classes\QueryBuilderFilter;


use Illuminate\Database\Eloquent\Builder;

class Filter
{
    /**
     * @var Builder
     */
    private $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    /**
     * apply filters on input Query
     *
     * @param array $filters
     * @return  Builder
     */
    public function apply(array $filters): Builder
    {
        foreach ($filters as $key => $filter) {
            $value = request($key);
            // according to ConvertEmptyStringsToNull middleware '' convert to null
            if (!is_null($value) && $value !== []) {
                /** @var FilterContract $filterObject */
                $filterObject = new $filter($this->query);
                $this->query = $filterObject->applyFilter($value);
            }
        }

        return $this->query;
    }
}