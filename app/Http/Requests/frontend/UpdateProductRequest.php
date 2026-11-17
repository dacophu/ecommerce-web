<?php

namespace App\Http\Requests\frontend;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'price' => 'required',
            'id_category' => 'required',
            'id_brand' => 'required',
            'sale' => 'required',
            'company' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:1048',
            'detail' => 'required'
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
