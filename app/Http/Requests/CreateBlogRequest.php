<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ApiRequest;

class CreateBlogRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'image' => 'required|mimes:jpg,jpeg,png|max:10000',
            'short_desc' => 'nullable|string|max:255',
            'long_desc' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Chưa nhập tiêu đề kìa !',
            'name.max' => 'Không được quá 255 ký tự !',
            'url.required' => 'Chưa nhập tiêu đề kìa !',
            'url.max' => 'Không được quá 255 ký tự !',
            'image.required' => 'Hãy chọn ảnh đại diện !',
            'image.mimes' => 'Ảnh phải là định dạng jpg, jpeg, png !',
            'image.max' => 'Ảnh không quá 10MB !',
            'short_desc.max' => 'Mô tả không quá 255 ký tự !'
        ];
    }
}
