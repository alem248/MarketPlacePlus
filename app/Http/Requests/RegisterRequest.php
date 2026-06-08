<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:80'],
            'last_name'  => ['required', 'string', 'max:80'],
            'dob' => 'required|date',
            'gender'     => ['nullable', 'in:male,female,other,prefer_not_to_say'],
            'email'      => ['required', 'email', 'unique:users,email'],
            'phone'      => ['required', 'string', 'max:20'],
            'password'   => ['required', 'string', 'min:8'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'El nombre es obligatorio.',
            'last_name.required'  => 'Los apellidos son obligatorios.',
            'dob.required'        => 'La fecha de nacimiento es obligatoria.',
            'dob.date_format'     => 'La fecha debe tener el formato DD/MM/YYYY.',
            'email.required'      => 'El correo electrónico es obligatorio.',
            'email.email'         => 'El correo electrónico no es válido.',
            'email.unique'        => 'Este correo ya está registrado.',
            'phone.required'      => 'El número de WhatsApp es obligatorio.',
            'password.required'   => 'La contraseña es obligatoria.',
            'password.min'        => 'La contraseña debe tener al menos 8 caracteres.',
        ];
    }
}
