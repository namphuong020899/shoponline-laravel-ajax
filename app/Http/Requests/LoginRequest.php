<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email_login'=>'required',
            'password_login'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'email_login.required' => 'Tên đăng nhập không được bỏ trống!',
            'password_login.required' => 'Mật khẩu không được bỏ trống!',
        ];
    }
    }
