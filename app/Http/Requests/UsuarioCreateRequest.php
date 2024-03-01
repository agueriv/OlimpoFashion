<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioCreateRequest extends FormRequest
{
    function attributes()
    {
        return [
            'name' => 'nombre del usuario',
            'email' => 'email del usuario',
            'puesto' => 'puesto del usuario'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    function messages()
    {
        $required = 'El :attribute es obligatorio.';
        $max = 'La longitud mínima para el :attribute es de :max carácteres.';
        $string = 'El :attribute debe ser una cadena.';

        return [
            // Requires
            'name.required' => $required,
            'email.required' => $required,
            'puesto.required' => $required,
            // Strings
            'name.string' => $string,
            'email.string' => $string,
            // Enums
            'puesto.in' => 'Los usuarios disponibles son jefe o empleado.',
            // Maximos 
            'name.max' => $max,
            'email.max' => $max,
            // Email
            'email.email' => 'El :attribute debe ser un email válido',
            // Unique
            'email.unique' => 'Este email ya esta registrado'
        ];
    }

    // reglas de validacion de admin
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:1|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'puesto' => 'required|in:jefe,empleado'
        ];
    }
}
