<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ApiRequest;

class CreateProductImageRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'images' => 'array',
            'images.*' => [
                'mimes:jpg,jpeg,png',
                function($attribute, $value, $fail)
                {
                    $fileSize = $value->getSize() / 1024; # Byte to Kb
                    $fileName = $value->getClientOriginalName();
                    return ($fileSize > 10000)
                        ? $fail("Ảnh ". $fileName . " quá 10MB rồi !")
                        : true;
                }
            ]
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Bắt buộc có product_id !',
            'product_id.exists' => 'Không có sản phẩm này !',
            'images.*.mimes' => 'Ảnh phải có định dạng jpg, jpeg, png'
        ];
    }
}
