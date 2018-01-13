<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'name'   => 'required|min:5',
            'parent'   => 'required|min:5',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Vui lòng nhập tên danh mục',
            'parent.required' => 'Vui lòng nhập tên danh mục',
            'name.min' => 'Tên danh mục tối thiểu 5 ký tự',
        ];
    }
}