<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
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
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute : không được để trống',
            'image' => ':attribute : Hình ảnh upload phải là hình ảnh',
            'mimes' => ':attribute : Hình ảnh upload phải dịnh dạng như sau: jpeg,jpg,png,gif',
            'image.max' => ':attribute :Hình ảnh upload vượt quá kích thước cho phép :max'
        ];
    }
}
