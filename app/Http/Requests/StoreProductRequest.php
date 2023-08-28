<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|max:50",
            "price" => "required|numeric",
            "description" => "max:255",
            "thumb" => "nullable|url",
        ];
    }

public function messages(): array
{
    return [
        'name.required' => 'il nome è richiesto',
        'name.max' => 'Il nome non può superare i 50 caratteri.',
        'price.required' => 'il prezzo è richiesto',
        'description.max' => 'la descrizione non può superare i 255 caratteri'
    ];
}
}
