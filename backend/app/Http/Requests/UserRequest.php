<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('id'); 
    
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $userId, 
            'email' => 'nullable|email|unique:users,email,' . $userId, 
            // 'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', Chưa có view thêm ảnh
            'avatar' => 'nullable',
            'address' => 'nullable|string|max:500',
            'phone_number' => 'nullable|string|max:10', 
            'password' => 'required|string|min:6',
        ];
        

    }
    public function messages(): array{

        return [
            'username.unique' => 'Username đã tồn tại.',
            'email.unique' => 'Email đã tồn tại.',
            'avatar.required' => 'Vui lòng chọn ảnh đại diện.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'address.max' => 'Địa chỉ quá dài (500 ký tự).',
            'phone_number.max' => 'Số điện thoại quá dài (10 ký tự).',
            'name.max' => 'Tên quá dài (255 ký tự).',
            'email.email' => 'Vui lòng nhập đúng định dạng email.'
        ];
    }
}