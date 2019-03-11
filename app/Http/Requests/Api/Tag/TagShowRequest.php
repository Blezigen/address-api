<?php

namespace App\Http\Requests\Api\Tag;

use App\Http\Requests\Api\ApiRequest;

class TagShowRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return TagRules::show($this->route('tag'));
    }
}
