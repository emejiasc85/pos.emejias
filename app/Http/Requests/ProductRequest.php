<?php

namespace EmejiasInventory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'                    => 'required',
            'description'             => 'nullable',
            'minimum_stock'           => 'numeric',
            'product_presentation_id' => 'required|exists:product_presentations,id',
            'product_serie_id'        => 'required|exists:product_series,id',
            'category_id'             => 'required|exists:categories,id',
            'product_group_id'        => 'required|exists:product_groups,id',
            'unit_measure_id'         => 'required|exists:unit_measures,id',
            'make_id'                 => 'required|exists:makes,id',
            'barcode'                 => 'nullable|unique:products,barcode',
            'price'                   => 'nullable|numeric|min:0|required_if:make_order,1',
            'offer_price'             => 'nullable|numeric|min:0|required_if:make_order,1',
            'purchase_price'          => 'required_if:make_order,1',
            'lot'                     => 'required_if:make_order,1',
            'people_id'               => 'required_if:make_order,1|exists:people,id'
        ];
    }
}
