<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ApiRequest;

class CreateSliderRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url' => 'max:255|string|nullable',
            'image' => 'mimes:jpeg,jpg,png,webp|max:10000|required',
        ];
    }

    public function messages()
    {
        return [
            'url.max' => 'Đường dẫn vượt quá 255 ký tự rồi !',
            'image.mimes' => 'Ảnh sai định dạng. Chỉ cho phép jpg, jpeg, png',
            'image.max' => '10Mb ảnh sẽ nặng server lắm !',
            'image.required' => 'Chưa chọn ảnh rồi nè !'
        ];
    }
}
