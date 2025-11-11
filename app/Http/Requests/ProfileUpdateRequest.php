<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.lowercase' => 'L\'adresse mail doit être en lettres minuscules',
            'email.email' => 'Le format de l\'adresse email est invalide',
            'email.max' => 'L\'adresse mail ne peut pas dépasser :max caractères',
            'email.unique' => 'Cette adresse mail est déjà utilisée',
        ];
    }
}
