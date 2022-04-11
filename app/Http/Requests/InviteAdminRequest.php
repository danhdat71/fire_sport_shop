<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ApiRequest;

class InviteAdminRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'max:255|string|email|unique:users,email',
        ];
    }

    public function messages()
    {
        return [
            'email.max' => 'Email vượt quá 255 ký tự rồi !',
            'email.string' => 'Email phải là kiểu string !',
            'email.email' => 'Email sai định dạng !',
            'email.unique' => 'Email đã tồn tại !'
        ];
    }
}
