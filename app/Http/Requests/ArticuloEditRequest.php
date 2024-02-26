<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticuloEditRequest extends ArticuloCreateRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        return $rules;
    }
}
