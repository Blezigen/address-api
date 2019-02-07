<?php

namespace App\Http\Controllers\Api\Country;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Country\CountryDestroyRequest;
use App\Http\Requests\Api\Country\CountryIndexRequest;
use App\Http\Requests\Api\Country\CountryShowRequest;
use App\Http\Requests\Api\Country\CountryStoreRequest;
use App\Http\Requests\Api\Country\CountryUpdateRequest;
use App\Http\Resources\ResourceFactory;
use App\Jobs\Api\Country\CountryDestroyJob;
use App\Jobs\Api\Country\CountryIndexJob;
use App\Jobs\Api\Country\CountryStoreJob;
use App\Jobs\Api\Country\CountryUpdateJob;
use App\Models\Address\Country;

class CountryController extends ApiController
{

    public function index(CountryIndexRequest $request)
    {
        $countries = CountryIndexJob::dispatchNow($request->all());
        $resource  = ResourceFactory::resourceCollection("countries", $countries);
        return $this->response($resource);
    }

    public function show(CountryShowRequest $request, Country $country)
    {
        $resource = ResourceFactory::resourceObject("country", $country);
        return $this->response($resource);
    }

    public function store(CountryStoreRequest $request)
    {
        $data     = $request->validated();
        $country  = CountryStoreJob::dispatchNow($data);
        $resource = ResourceFactory::resourceObject("country", $country);

        return $this->response($resource);
    }

    public function update(CountryUpdateRequest $request, Country $country)
    {
        $data     = $request->validated();
        $country  = CountryUpdateJob::dispatchNow($country, $data);
        $resource = ResourceFactory::resourceObject("country", $country);

        return $this->response($resource);
    }

    public function destroy(CountryDestroyRequest $request, Country $country)
    {
        $country = CountryDestroyJob::dispatchNow($country);
        return $this->response($country);
    }

}
