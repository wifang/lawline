<?php

namespace App\Api\V1\Requests;

use Config;
use Dingo\Api\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules()
    {
        return Config::get('input.product.validation_rules');
    }

    public function authorize()
    {
        return true;
    }
}
