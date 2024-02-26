<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticuloCreateRequest extends FormRequest
{
    function attributes()
    {
        return [
            'nombre' => 'nombre del artículo',
            'seccion' => 'sección del artículo',
            'temporada' => 'temporada del artículo',
            'picture' => 'imagen del artículo',
            'idcategoria' => 'categoría del artículo',
            'en_rebaja' => 'artículo rebajado',
            'precio' => 'precio del artículo',
            'precio_rebaja' => 'precio rebajado del artículo',
            'descripcion' => 'descripción del artículo'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    function messages()
    {
        $required = 'El :attribute es obligatorio.';
        $requireda = 'La :attribute es obligatoria.';
        $min = 'La longitud mínima para el :attribute es de :min carácteres.';
        $mina = 'La longitud mínima para la :attribute es de :min carácteres.';
        $max = 'La longitud mínima para el :attribute es de :max carácteres.';
        $maxa = 'La longitud mínima para la :attribute es de :max carácteres.';
        $string = 'El :attribute debe ser una cadena.';
        $stringa = 'La :attribute debe ser una cadena.';

        return [
            // Requires
            'nombre.required' => $required,
            'seccion.required' => $requireda,
            'temporada.required' => $requireda,
            'picture.required' => $requireda,
            'idcategoria.required' => $requireda,
            'precio.required' => $required,
            'descripcion.required' => $requireda,
            // Strings
            'nombre.string' => $string,
            'descripcion.string' => $stringa,
            // Enums
            'seccion.in' => 'La secciones disponibles son hombre(h), mujer(m), niños(n) y/o todos(all).',
            'temporada.in' => 'Las temporadas disponibles son primavera/verano(pri-ver), otoño/invierno(oto-inv) y/o todo el año(all)',
            // Minimos
            'nombre.min' => $min,
            'descripcion.min' => $mina,
            // Maximos 
            'nombre.max' => $max,
            'descripcion.max' => $maxa,
            // Mimetypes
            'picture.mimetypes' => 'El tipo de imagen seleccionado no está permitido.',
            // Integer
            'idcategoria.int' => 'La :attribute debe ser un entero.',
            // Booleans
            'en_rebaja.boolean' => 'Los valores permitidos para la casilla de :attribute son true o false.',
            // Decimales
            'precio.decimal' => 'El :attribute tiene que ser un número con un máximo de :decimal decimales.',
            'precio_rebaja.decimal' => 'El :attribute tiene que ser un número con un máximo de :decimal decimales.',
            // Gtes
            'precio.gte' => 'El valor mínimo del :attribute es :value.',
            'precio_rebaja.gte' => 'El valor mínimo del :attribute es :value.',
            // Ltes
            'precio.lte' => 'El valor máximo del :attribute es :value.',
            'precio_rebaja.lte' => 'El valor máximo del :attribute es :value.',
        ];
    }

    // reglas de validacion de admin
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|min:1|max:120',
            'seccion' => 'required|in:h,m,n,all',
            'temporada' => 'required|in:pri-ver,oto-inv,all',
            'picture' => 'required|mimetypes:image/jpeg,image/png,image/bmp,image/svg',
            'idcategoria' => 'requried|int',
            'en_rebaja' => 'nullable|boolean',
            'precio' => 'required|decimal:0,2|gte:-999999.99|lte:999999.99',
            'precio_rebaja' => 'nullable|decimal:0,2|gte:-999999.99|lte:999999.99',
            'descripcion' => 'required|string|min:1|max:1000'
        ];
    }
}
