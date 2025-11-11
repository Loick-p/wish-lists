<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormWishListRequest extends FormRequest
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
            'title' =>  ['required', 'min:4', 'max:255'],
            'description' => ['required', 'min:8'],
            'date' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Le titre est obligatoire.',
            'title.min' => "Le titre doit comporter au moins :min caractère(s).",
            'title.max' => "Le titre ne peut pas dépasser :max caractères.",
            'description.required' => 'La description est obligatoire.',
            'description.min' => "La description doit comporter au moins :min caractère(s).",
            'date.required' => 'La date est obligatoire.',
        ];
    }
}
