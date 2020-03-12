<?php

namespace App\Http\Request\Level;

use Illuminate\Foundation\Http\FormRequest;

class AddLevel extends FormRequest
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
            'level_name' => 'required|string|unique:levels|max:191',
            'description' => 'nullable|string|max:225',
        ];
    }

    public function messages() {
        return [
            'level_name.required' => 'Vui lòng nhập tên trình độ',
            'level_name.unique' => 'Tên này đã tồn tại',
            'level_name.max' => 'Vui lòng không nhập quá 191 ký tự',

            'description.max' => 'Vui lòng không nhập quá 225 ký tự',
        ];
    }
}
