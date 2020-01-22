<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'user_id'   => 'required|integer|exists:users,id',
            'recreation_id'   => 'required|integer|exists:recreations,id',
            'rating'  => 'integer|min:1|max:5',
            'comment'  => 'nullable|string',
        ];
    }
}
