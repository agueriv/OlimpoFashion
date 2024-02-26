<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaEditRequest extends CategoriaCreateRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $rules['nombre'] = 'required|string|min:1|max:200|unique:categoria,nombre,' . $this->categoria->id;
        return $rules;
    }
}
