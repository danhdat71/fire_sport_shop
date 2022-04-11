<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ApiRequest;
use App\Services\UserService;

class AdminSignInRequest extends ApiRequest
{
    /**
     * Global variable
     * **/
    protected $userService;

    /**
     * Constructor
     * **/
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'birthday' => 'required|date_format:Y-m-d',
            'gender' => 'min:1|max:2|required|numeric',
            'password' => 'min:8|max:255|required',
            'confirm_password' => 'min:8|max:255|required|same:password',
            'image' => 'nullable|mimes:jpg,png,jpeg|max:10000',
            'address' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Chưa nhập họ tên kìa !',
            'name.max' => 'Tên không quá :max ký tự !',
            'gender.required' => 'Chưa chọn giới tính kìa !',
            'gender.min' => 'Trạng thái giới tính không dưới :min !',
            'gender.max' => 'Trạng thái giới tính không quá :max !',
            'gender.numeric' => 'Trạng thái giới tính dạng số !',
            'password.min' => 'Mật khẩu phải lớn hơn :min ký tự !',
            'password.max' => 'Mật khẩu phải nhỏ hơn :min ký tự !',
            'password.required' => 'Vui lòng nhập mật khẩu !',
            'confirm_password.min' => 'Mật khẩu phải lớn hơn :min ký tự !',
            'confirm_password.max' => 'Mật khẩu phải nhỏ hơn :max ký tự !',
            'confirm_password.required' => 'Vui lòng nhập mật khẩu xác nhận !',
            'confirm_password.same' => 'Mật khẩu nhắc lại không khớp !',
            'image.mimes' => 'Ảnh phải là jpg, jpeg hoặc png !',
            'image.max' => 'Ảnh không quá 10Mb !',
            'address.max' => 'Địa chỉ không quá :max ký tự !',
            'birthday.required' => 'Chưa chọn ngày sinh nhật !',
            'birthday.format' => 'Sai định dạng ngày tháng năm chuẩn !'
        ];
    }
}
