<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ApiRequest;

class UpdateProductRequest extends ApiRequest
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
            'url' => 'required|max:255',
            'from' => 'required|max:255',
            'image_1' => 'nullable|mimes:jpg,jpeg,png|max:10000',
            'image_2' => 'nullable|mimes:jpg,jpeg,png|max:10000',
            'price_sale' => 'required|numeric',
            'price_root' => 'nullable|numeric',
            'category_id' => 'required|exists:product_categories,id',
            'sizes' => 'required',
            'short_desc' => 'nullable|string',
            'ckeditor_1' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Chưa nhập tiêu đề kìa !',
            'name.max' => 'Tiêu đề quá :max ký tự rồi !',
            'url.required' => 'Chưa có url kìa !',
            'url.max' => 'URL quá :max ký tự rồi !',
            'from.required' => 'Xuất sứ chưa nhập kìa !',
            'from.max' => 'Xuất sứ quá :max ký tự rồi !',
            'image_1.mimes' => 'Ảnh phải có định dạng jpg, jpeg, png !',
            'image_1.max' => 'Ảnh phải dưới 10MB nghe !',
            'image_2.mimes' => 'Ảnh phải có định dạng jpg, jpeg, png !',
            'image_2.max' => 'Ảnh phải dưới 10MB nghe !',
            'price_sale.required' => 'Quên nhập giá sản phẩm rồi kìa !',
            'price_sale.numeric' => 'Giá sản phẩm phải là số nghe !',
            'price_root.numeric' => 'Giá sản phẩm phải là số nghe !',
            'category_id.required' => 'Thiếu id loại sản phẩm rồi !',
            'category_id.exists' => 'ID loại sản phẩm không tồn tại !',
            'size.required' => 'Vui lòng chọn size !',
        ];
    }
}
