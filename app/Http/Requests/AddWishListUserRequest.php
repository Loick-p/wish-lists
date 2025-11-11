<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddWishListUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'lowercase', 'email', 'exists:users,email'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'L\'adresse mail est obligatoire.',
            'email.lowercase' => 'L\'adresse mail doit être en lettres minuscules',
            'email.email' => 'Le format de l\'adresse mail est invalide',
            'email.exists' => 'Adresse mail introuvable.'
        ];
    }
}
