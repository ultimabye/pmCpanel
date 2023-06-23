<?php

namespace Modules\GiftCard\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CreateGiftCardRequest extends FormRequest
{
    
    public function rules()
    {
        return [
            'name' => 'nullable|required_if:product_type,1|max:255',
            'gift_name' => 'nullable|required_if:product_type,2|max:255',
            'gift_sku' => 'nullable|required_if:product_type,2|max:255',
            'descriptionOne' => 'nullable|required_if:product_type,2',
            'selling_price' => 'nullable|numeric|required_if:product_type,1',
            'discount' => 'nullable|numeric|nullable',
            'sku' => 'nullable|required_if:product_type,1|max:15|min:5|unique:gift_cards,sku',
            'status' => 'nullable|required_if:product_type,1',
            'thumbnail_image' => 'nullable|required_if:product_type,1|mimes:jpg,bmp,jpeg,png,webp',
            'thumbnail_image_one' => 'nullable|required_if:product_type,2|mimes:jpg,bmp,jpeg,png,webp',
            'galary_image_two.*' => 'nullable|required_if:product_type,2|mimes:jpg,bmp,jpeg,png,webp',
            'galary_image.*' => 'nullable|mimes:jpg,bmp,jpeg,png,webp'
        ];
    }

    
    public function authorize()
    {
        return true;
    }
}
