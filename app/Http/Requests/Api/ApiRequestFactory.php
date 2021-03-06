<?php

namespace App\Http\Requests\Api;

use App\Exceptions\Api\NotImplementedException;
use App\Http\Requests\Api\City\CityDestroyRequest;
use App\Http\Requests\Api\City\CityIndexRequest;
use App\Http\Requests\Api\City\CityRules;
use App\Http\Requests\Api\City\CityShowRequest;
use App\Http\Requests\Api\City\CityStoreRequest;
use App\Http\Requests\Api\City\CityUpdateRequest;
use App\Http\Requests\Api\Country\CountryDestroyRequest;
use App\Http\Requests\Api\Country\CountryIndexRequest;
use App\Http\Requests\Api\Country\CountryRules;
use App\Http\Requests\Api\Country\CountryShowRequest;
use App\Http\Requests\Api\Country\CountryStoreRequest;
use App\Http\Requests\Api\Country\CountryUpdateRequest;
use App\Http\Requests\Api\MediaObject\MediaObjectDestroyRequest;
use App\Http\Requests\Api\MediaObject\MediaObjectIndexRequest;
use App\Http\Requests\Api\MediaObject\MediaObjectRules;
use App\Http\Requests\Api\MediaObject\MediaObjectShowRequest;
use App\Http\Requests\Api\MediaObject\MediaObjectStoreRequest;
use App\Http\Requests\Api\MediaObject\MediaObjectUpdateRequest;
use App\Http\Requests\Api\Person\PersonDestroyRequest;
use App\Http\Requests\Api\Person\PersonIndexRequest;
use App\Http\Requests\Api\Person\PersonRules;
use App\Http\Requests\Api\Person\PersonShowRequest;
use App\Http\Requests\Api\Person\PersonStoreRequest;
use App\Http\Requests\Api\Person\PersonUpdateRequest;
use App\Http\Requests\Api\Region\RegionDestroyRequest;
use App\Http\Requests\Api\Region\RegionIndexRequest;
use App\Http\Requests\Api\Region\RegionRules;
use App\Http\Requests\Api\Region\RegionShowRequest;
use App\Http\Requests\Api\Region\RegionStoreRequest;
use App\Http\Requests\Api\Region\RegionUpdateRequest;
use App\Http\Requests\Api\State\StateDestroyRequest;
use App\Http\Requests\Api\State\StateIndexRequest;
use App\Http\Requests\Api\State\StateRules;
use App\Http\Requests\Api\State\StateShowRequest;
use App\Http\Requests\Api\State\StateStoreRequest;
use App\Http\Requests\Api\State\StateUpdateRequest;
use App\Http\Requests\Api\Tag\TagDestroyRequest;
use App\Http\Requests\Api\Tag\TagIndexRequest;
use App\Http\Requests\Api\Tag\TagRules;
use App\Http\Requests\Api\Tag\TagShowRequest;
use App\Http\Requests\Api\Tag\TagStoreRequest;
use App\Http\Requests\Api\Tag\TagUpdateRequest;
use App\Http\Requests\Api\Vendor\VendorDestroyRequest;
use App\Http\Requests\Api\Vendor\VendorIndexRequest;
use App\Http\Requests\Api\Vendor\VendorRules;
use App\Http\Requests\Api\Vendor\VendorShowRequest;
use App\Http\Requests\Api\Vendor\VendorStoreRequest;
use App\Http\Requests\Api\Vendor\VendorUpdateRequest;
use Illuminate\Support\Facades\App;

class ApiRequestFactory
{

    public static function make($class)
    {
        return App::make($class);
    }

    /**
     * @param $resourceIdentifier
     * @return string
     * @throws NotImplementedException
     */
    public static function index($resourceIdentifier)
    {

        switch ($resourceIdentifier) {
            case 'countries':
                return CountryIndexRequest::class;
            case 'states':
                return StateIndexRequest::class;
            case 'people':
                return PersonIndexRequest::class;
            case 'cities':
                return CityIndexRequest::class;
            case 'regions':
                return RegionIndexRequest::class;
            case 'vendors':
                return VendorIndexRequest::class;
            case 'tags':
                return TagIndexRequest::class;
            case 'media_objects':
                return MediaObjectIndexRequest::class;
            default:
                throw new NotImplementedException("IndexRequest for '$resourceIdentifier' is not defined in ApiRequestFactory");
        }

    }

    /**
     * @param $resourceIdentifier
     * @return string
     * @throws NotImplementedException
     */
    public static function show($resourceIdentifier)
    {

        switch ($resourceIdentifier) {
            case 'countries':
                return CountryShowRequest::class;
            case 'states':
                return StateShowRequest::class;
            case 'people':
                return PersonShowRequest::class;
            case 'cities':
                return CityShowRequest::class;
            case 'regions':
                return RegionShowRequest::class;
            case 'vendors':
                return VendorShowRequest::class;
            case 'tags':
                return TagShowRequest::class;
            case 'media_objects':
                return MediaObjectShowRequest::class;
            default:
                throw new NotImplementedException("ShowRequest for '$resourceIdentifier' is not defined in ApiRequestFactory");
        }

    }

    /**
     * @param $resourceIdentifier
     * @return string
     * @throws NotImplementedException
     */
    public static function store($resourceIdentifier)
    {

        switch ($resourceIdentifier) {
            case 'countries':
                return CountryStoreRequest::class;
            case 'states':
                return StateStoreRequest::class;
            case 'people':
                return PersonStoreRequest::class;
            case 'cities':
                return CityStoreRequest::class;
            case 'regions':
                return RegionStoreRequest::class;
            case 'vendors':
                return VendorStoreRequest::class;
            case 'tags':
                return TagStoreRequest::class;
            case 'media_objects':
                return MediaObjectStoreRequest::class;
            default:
                throw new NotImplementedException("StoreRequest for '$resourceIdentifier' is not defined in ApiRequestFactory");
        }

    }

    /**
     * @param $resourceIdentifier
     * @return string
     * @throws NotImplementedException
     */
    public static function update($resourceIdentifier)
    {

        switch ($resourceIdentifier) {
            case 'countries':
                return CountryUpdateRequest::class;
            case 'states':
                return StateUpdateRequest::class;
            case 'people':
                return PersonUpdateRequest::class;
            case 'cities':
                return CityUpdateRequest::class;
            case 'regions':
                return RegionUpdateRequest::class;
            case 'vendors':
                return VendorUpdateRequest::class;
            case 'tags':
                return TagUpdateRequest::class;
            case 'media_objects':
                return MediaObjectUpdateRequest::class;
            default:
                throw new NotImplementedException("UpdateRequest for '$resourceIdentifier' is not defined in ApiRequestFactory");
        }

    }

    /**
     * @param $resourceIdentifier
     * @return string
     * @throws NotImplementedException
     */
    public static function destroy($resourceIdentifier)
    {

        switch ($resourceIdentifier) {
            case 'countries':
                return CountryDestroyRequest::class;
            case 'states':
                return StateDestroyRequest::class;
            case 'people':
                return PersonDestroyRequest::class;
            case 'cities':
                return CityDestroyRequest::class;
            case 'regions':
                return RegionDestroyRequest::class;
            case 'vendors':
                return VendorDestroyRequest::class;
            case 'tags':
                return TagDestroyRequest::class;
            case 'media_objects':
                return MediaObjectDestroyRequest::class;
            default:
                throw new NotImplementedException("DestroyRequest for '$resourceIdentifier' is not defined in ApiRequestFactory");
        }

    }

    /**
     * @param $resourceIdentifier
     * @return string
     * @throws NotImplementedException
     */
    public static function rules($resourceIdentifier)
    {

        switch ($resourceIdentifier) {
            case 'countries':
                return CountryRules::class;
            case 'states':
                return StateRules::class;
            case 'people':
                return PersonRules::class;
            case 'cities':
                return CityRules::class;
            case 'regions':
                return RegionRules::class;
            case 'vendors':
                return VendorRules::class;
            case 'tags':
                return TagRules::class;
            case 'media_objects':
                return MediaObjectRules::class;
            default:
                throw new NotImplementedException("Rules for '$resourceIdentifier' is not defined in ApiRequestFactory");
        }

    }

}
