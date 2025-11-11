<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormGiftRequest extends FormRequest
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
            'wish_list_users_id' => ['required', 'exists:wish_list_users,id'],
            'added_by' => ['required', 'exists:users,id'],
            'title' =>  ['required', 'min:2', 'max:80'],
            'link' => ['nullable', 'url'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
            'description' => ['nullable', 'min:2', 'max:150'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Le nom est obligatoire.',
            'title.min' => "Le nom doit comporter au moins :min caractères.",
            'title.max' => "Le nom ne peut pas dépasser :max caractères.",
            'link.url' => "Le lien n'est pas valide.",
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => "L'image doit être au format :values.",
            'image.max' => "L'image ne peut pas dépasser :max Ko.",
            'description.min' => "La description doit comporter au moins :min caractères.",
            'description.max' => "La description ne peut pas dépasser :max caractères.",
        ];
    }
}
