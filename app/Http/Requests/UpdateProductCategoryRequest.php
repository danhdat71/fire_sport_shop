<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ApiRequest;

class UpdateProductCategoryRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'url' => 'nullable|max:255',
            'image' => 'mimes:jpeg,jpg,png|max:10000|nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Chưa nhập tiêu đề hi',
            'name.max' => 'Tiêu đề quá :max ký tự rồi',
            'url.required' => 'Chưa nhập URL kìa',
            'url.max' => 'Bắt buộc nhập URL hi',
            'image.required' => 'Chưa chọn ảnh hi',
            'image.mimes' => 'Ảnh có phải đuôi jpg, jpeg, png không hi',
            'image.max' => 'Tối đa ảnh là 10MB nhé !'
        ];
    }
}