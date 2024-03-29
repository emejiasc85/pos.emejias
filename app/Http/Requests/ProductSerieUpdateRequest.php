<?php

namespace EmejiasInventory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductSerieUpdateRequest extends FormRequest
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
        $serie = $this->route()->parameter('product_series');

        return [
            'name' => 'required|unique:product_series,name,'.$serie->id,
            'description' => 'nullable|max:255'
        ];
    }
}
