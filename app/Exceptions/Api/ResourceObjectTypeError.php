<?php

namespace App\Exceptions\Api;

use App\Exceptions\ApiErrorCode;
use App\Exceptions\BaseException;
use Symfony\Component\HttpFoundation\Response;

class ResourceObjectTypeError extends BaseException
{

    protected $message        = 'exceptions.no_fit.type';
    protected $code           = Response::HTTP_NOT_FOUND;
    protected $api_error_code = ApiErrorCode::AUTH_TOKEN_NOT_PROVIDED;

    public function __construct($givenType, $expectedType)
    {
        parent::__construct($this->message, $this->code);

        $this->setMessageLocalizations([
            'type'          => $givenType,
            'expected_type' => $expectedType,
        ]);
    }

}
