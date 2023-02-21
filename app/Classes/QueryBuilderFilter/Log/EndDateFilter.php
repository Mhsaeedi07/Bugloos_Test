<?php


namespace App\Classes\QueryBuilderFilter\Log;

use App\Classes\QueryBuilderFilter\FilterContract;
use Illuminate\Database\Eloquent\Builder;


class EndDateFilter extends FilterContract
{
    /**
     * @inheritDoc
     */
    public function applyFilter($value = null): Builder
    {
        return $this->query->Where('date', '<=', '%' . $value . '%');
    }
}
