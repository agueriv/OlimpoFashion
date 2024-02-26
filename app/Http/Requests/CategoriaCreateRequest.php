<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaCreateRequest extends FormRequest
{
    function attributes() {
        return [
            'nombre' => 'nombre de la categoría',
        ];
    }

    public function authorize(): bool {
        return true;
    }
     
     function messages() {
        $required = 'El :attribute es obligatorio.';
        $min = 'La longitud mínima para el :attribute es de :min carácteres.';
        $max = 'La longitud mínima para el :attribute es de :max carácteres.';
        $string = 'El :attribute debe ser una cadena.';
         
         return [
             'nombre.required' => $required,
             'nombre.min' => $min,
             'nombre.string' => $string,
             'nombre.max' => $max,
             'nombre.unique' => 'Esta categoría ya esta registrada en la base de datos'
         ];
     }
     
    public function rules(): array {
        return [
            'nombre' => 'required|string|min:1|max:200|unique:categoria,nombre',
        ];
    }
}
