<?php


namespace App\Classes\QueryBuilderFilter\Log;

use App\Classes\QueryBuilderFilter\FilterContract;
use Illuminate\Database\Eloquent\Builder;


class ServiceNamesFilter extends FilterContract
{
    /**
     * @inheritDoc
     */
    public function applyFilter($value = null): Builder
    {
        return $this->query->Where('service_name', 'like', '%' . $value . '%');
    }
}
