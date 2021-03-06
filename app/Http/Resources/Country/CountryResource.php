<?php

namespace App\Http\Resources\Country;

use App\Http\Resources\ResourceObject;
use App\Jobs\Related\RelatedIndexJob;
use App\Models\Address\Country;

class CountryResource extends ResourceObject
{

    public function get_model()
    {
        return Country::class;
    }

    protected function get_default_fields()
    {
        return $this->get_all_fields();
    }

    protected function get_all_fields()
    {
        return [
            'name',
            'code2',
            'code3',
            'created_at',
            'updated_at',
        ];
    }

    protected function get_relationships()
    {
        return [
            'region',
            'states',
            'capital',
            'tags',
        ];
    }

    protected function get_relationship($relationship, $request_data)
    {
        return RelatedIndexJob::dispatchNow($request_data, $this->resource, $relationship);
    }

    public function name()
    {
        return $this->name;
    }

    public function code2()
    {
        return $this->code2;
    }

    public function code3()
    {
        return $this->code3;
    }

    public function created_at()
    {
        return (string)$this->created_at;
    }

    public function updated_at()
    {
        return (string)$this->updated_at;
    }

}
