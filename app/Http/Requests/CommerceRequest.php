<?php

namespace EmejiasInventory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommerceRequest extends FormRequest
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
            'name'      => 'required',
            'address'   => 'required',
            'phone'     => 'required|digits_between:8,11',
            'other_phone' => 'nullable|digits_between:8,11',
            'nit'       => 'nullable|digits_between:7,8',
            'logo'      => 'nullable|image',
            'tax'       => 'nullable|numeric',
            'profit'    => 'nullable|numeric'
        ];
    }
}
