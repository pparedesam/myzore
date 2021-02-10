<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
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

    public function messages()
    {
        return [
            'nombre.required' => 'Ingrese un nombre para el producto.',
            'descripcion.required' => 'Ingrese una descripción para el producto.',
            'precio.numeric' => 'Ingrese un monto correcto.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'numeric',
        ];
    }
}
