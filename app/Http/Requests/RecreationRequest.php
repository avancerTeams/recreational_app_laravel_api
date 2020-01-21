<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecreationRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|string|max:255',
            'address'       => 'required|string|max:255',
            'location_id'   => 'required|integer|exists:locations,id',
            'category_id'   => 'required|integer|exists:categories,id',
            'active'        => 'boolean',
            'opening_hour'  => 'nullable|string|max:5',// [12:00]
            'closing_hour'  => 'nullable|string|max:5',// [12:00]
        ];
    }
}
