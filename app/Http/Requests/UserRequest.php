<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:6|max:32',
            'email' => 'min:6',
            'password' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Tên Phải nhập",
            'name.min'=> "Phải từ 6 kí tự trở lên",
            'name.max'=> "phải tối đa 32 kí tự",
            'email.min'=> "email phải tối thiểu 5 ký tự",
            'password.required'=> "Bắt buộc phải điền mật khẩu"
        ]; 
    }
}
