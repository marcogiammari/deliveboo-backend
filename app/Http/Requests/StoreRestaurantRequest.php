<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
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
            "name"=>"required|max:100",
            "vat_number"=>"required|max:20",
            "note"=>"nullable|max:255",
            "city" => 'required|max:30',
            "street_name" => 'required|max:50',
            "street_number" => 'required|max:15',
            "zip_code" => 'required|max:15',
            "categories" => 'required|exists:categories,id',
            "thumb" => 'nullable'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'il nome è richiesto',
            'name.max' => 'Il nome non può superare i 100 caratteri.',
            'vat_number.required' => 'il codice partita iva è richiesto',
            'vat_number.max' => 'Il codice partita iva non può superare i 20 caratteri.',
            'note.max' => 'la descrizione non può superare i 255 caratteri',
            'city.required' => 'La città è richiesta',
            'city.max' => 'La città non può superare i 30 caratteri',
            'street_name.required' => 'La via è richiesta',
            'street_name.max' => 'Il nome della via non può superare i 50 caratteri',
            'street_number.required' => 'Il numero civico è richiesto',
            'street_number.max' => 'Il numero civico non può superare i 15 caratteri',
            'zip_code.required' => 'Il codice postale è richiesto',
            'zip_code.max' => 'Il codice postale non può superare i 15 caratteri',
        ];
    }
}
