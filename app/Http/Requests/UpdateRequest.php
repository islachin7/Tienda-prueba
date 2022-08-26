<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name.required' => 'El nombre es requerido.',
            'name.max' => 'Maximo permitio para nombre de 80 caracteres.',
            'email.required' => 'El email es requerido.',
            'email.unique' => 'El email ya esta registrado.',
            'apellido_paterno.required' => 'El apellido es requerido.',
            'documento.required' => 'El documento es requerido.',
            'celular.required' => 'El celular es requerido.',
            'direccion.required' => 'La direccion es requerida.',
            'direccion.max' => 'Maximo de caracteres para direccion.',
            'documento.max' => 'Maximo de caracteres para documento.',
            'celular.max' => 'Maximo de caracteres para celular.',
            'password.required' => 'La contraseña es requerida.',
            'password.max' => 'Maximo de caracteres permitidos para la contraseña.',
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
            'name' => 'required|max:80',
            'documento' => 'max:12',
            'celular' => 'max:15',
        ];
    }
}
