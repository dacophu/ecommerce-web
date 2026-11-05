<?php

namespace App\Http\Requests\frontend;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterMemberRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:users',
            'address' => 'required',
            'id_country' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute : không được để trống',
            'email.email' => ':attribute : email sai định dạng',
            'email.unique' => ':attribute :email đã tồn tại',
            'avatar' => ':attribute : Hình ảnh upload phải là hình ảnh',
            'mimes' => ':attribute : Hình ảnh upload phải dịnh dạng như sau: jpeg,jpg,png,gif',
            'avatar.max' => ':attribute :Hình ảnh upload vượt quá kích thước cho phép :max'
        ];
    }
}
