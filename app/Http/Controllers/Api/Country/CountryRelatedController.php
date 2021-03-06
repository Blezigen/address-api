<?php

namespace App\Http\Controllers\Api\Country;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\City\CityIndexRequest;
use App\Http\Resources\ApiResourceFactory;
use App\Jobs\Related\RelatedDestroyJob;
use App\Jobs\Related\RelatedShowJob;
use App\Jobs\Related\RelatedUpdateJob;
use App\Jobs\Related\RelatedIndexJob;
use App\Jobs\Related\RelatedStoreJob;
use App\Models\Address\Country;
use Illuminate\Http\Request;

class CountryRelatedController extends ApiController
{

    public function index(CityIndexRequest $request, Country $country, $related)
    {
        // RelatedIndexJob already sends Resource back (single or collection) depending on relationship
        $resource = RelatedIndexJob::dispatchNow($request->all(), $country, $related);
        return $this->response($resource);
    }

    public function show(Request $request, Country $country, $related, $id)
    {
        $relative = RelatedShowJob::dispatchNow($request->all(), $country, $related, $id);
        $resource = ApiResourceFactory::resourceObject($relative::ID, $relative);
        return $this->response($resource);
    }

    public function store(Request $request, Country $country, $related)
    {
        $relative = RelatedStoreJob::dispatchNow($request->all(), $country, $related);
        $resource = ApiResourceFactory::resourceObject($relative::ID, $relative);
        return $this->response($resource);
    }

    public function update(Request $request, Country $country, $related, $id)
    {
        $relative = RelatedUpdateJob::dispatchNow($request->all(), $country, $related, $id);
        $resource = ApiResourceFactory::resourceObject($relative::ID, $relative);
        return $this->response($resource);
    }

    public function destroy(Request $request, Country $country, $related, $id)
    {
        $country = RelatedDestroyJob::dispatchNow($country, $related, $id);
        return $this->response($country);
    }

}
