<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioEditRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $rules['email'] = 'required|string|email|max:255|unique:users,email,' . $this->user->id;
        return $rules;
    }
}
