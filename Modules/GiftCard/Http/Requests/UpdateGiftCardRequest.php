<?php

namespace Modules\GiftCard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGiftCardRequest extends FormRequest
{
    
    public function rules()
    {
        return [
            'name' => 'nullable|required|max:255',
            'selling_price' => 'nullable|numeric|required',
            'discount' => 'nullable|numeric|nullable',
            'sku' => 'nullable|required|max:15|min:5|unique:gift_cards,sku,'.$this->id,
            'status' => 'nullable|required',
            'thumbnail_image' => 'nullable|mimes:jpg,bmp,jpeg,png,webp',
            'galary_image.*' => 'nullable|mimes:jpg,bmp,jpeg,png,webp'
        ];
    }

    
    public function authorize()
    {
        return true;
    }
}
