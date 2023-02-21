<?php


namespace App\Classes\QueryBuilderFilter\Log;

use App\Classes\QueryBuilderFilter\FilterContract;
use Illuminate\Database\Eloquent\Builder;


class StatusCodeFilter extends FilterContract
{
    /**
     * @inheritDoc
     */
    public function applyFilter($value = null): Builder
    {
        return $this->query->Where('status_code', 'like', '%' . $value . '%');
    }
}
