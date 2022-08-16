<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBillRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'note' => 'nullable|max:200',
            'town_id' => 'required|exists:devvn_xaphuongthitran,xaid',
            'address' => 'required|min:5|max:255',
            'phone' => 'required|numeric|digits_between:10,15',
            'name' => 'required|max:50|min:2',
            'products.*.id' => 'required|exists:products,id',
            'products.*.total' => 'required|numeric|min:1|max:500',
            'products.*.price' => 'required|numeric|digits_between:1,255',
            'products.*.colorName' => 'required|max:255',
            'products.*.sizeName' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'note.max' => 'Ghi chú tối đa :max ký tự !',
            
            'town_id.required' => 'Vui lòng cung cấp thông tin xã, phường, thị trấn !',
            'town_id.exists' => 'Không tồn tại xã này !',
            
            'address.required' => 'Vui lòng cung cấp địa chỉ giao hàng !',
            'address.min' => 'Địa chỉ giao hàng tối thiểu :min ký tự !',
            'address.max' => 'Địa chỉ giao hàng tối đa :max ký tự !',
            
            'phone.required' => 'Vui lòng điền số điện thoại !',
            'phone.numeric' => 'Số điện thoại phải là dạng số !',
            'phone.digits_between' => 'Số điện thoại [10-15] ký tự !',
            
            'name.required' => 'Vui lòng điền họ tên người nhận !',
            'name.min' => 'Tên người nhận tối thiểu :min ký tự !',
            'name.max' => 'Tên người nhận tối đa :max ký tự !',
            
            'products.*.id.required' => 'Vui cung cấp ID sản phẩm !',
            'products.*.id.exists' => 'ID sản phẩm không tồn tại !',

            'products.*.total.required' => 'Vui lòng cung cấp số lượng sản phẩm !',
            'products.*.total.numeric' => 'Số lượng sản phẩm phải là dạng số !',
            'products.*.total.min' => 'Số lượng sản phẩm tối thiểu :min !',
            'products.*.total.max' => 'Số lượng sản phẩm tối đa :max !',
            
            'products.*.price.required' => 'Vui lòng cung cấp giá bán !',
            'products.*.price.numeric' => 'Giá sản phẩm phải là dạng số !',
            'products.*.price.digits_between' => 'Giá sản phẩm từ [1-255] ký tự !',

            'products.*.colorName.required' => 'Vui lòng cung cấp màu sắc sản phẩm !',
            'products.*.colorName.max' => 'Màu sản phẩm tối đa :max ký tự !',
            
            'products.*.sizeName.required' => 'Vui lòng cung cấp Size sản phẩm !',
            'products.*.sizeName.max' => 'Size sản phẩm tối đa :max ký tự !'
        ];
    }
}
