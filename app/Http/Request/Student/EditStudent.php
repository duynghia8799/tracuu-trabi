<?php

namespace App\Http\Request\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class EditStudent extends FormRequest
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
    public function rules(Request $request)
    {
 
        return [
            'name' => 'required|string|max:191',
            'student_code' => 'required|string||unique:students,student_code,'. $request->get('id'),
            'birthday' => 'required|before:today',
            'phone' => 'nullable|numeric|digits_between:9,15',
            'email' => 'nullable|max:191|email',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Vui lòng nhập họ và tên học viên',
            'name.max' => 'Vui lòng không nhập quá 191 ký tự',

            'student_code.required' => 'Vui lòng nhập CMND hoặc Hộ chiếu',
            'student_code.unique' => 'Số CMND hoặc Hộ chiếu này đã tồn tại',
            'student_code.digits_between' => 'Số CMND hoặc Hộ chiếu có độ dài tối đa 20 kí tự',

            'birthday.required' => 'Vui lòng chọn ngày sinh',
            'birthday.before' => 'Ngày sinh phải trước ngày hiện tại',

            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.digits_between' => 'Số điện thoại tối thiếu là 10 số và tối đa là 15 số',
            'phone.numeric' => 'Vui lòng chỉ nhập số',

            'email.required' => 'Vui lòng nhập email',
            'email.max' => 'Vui lòng không nhập quá 191 ký tự',
            'email.email' => 'Vui lòng nhập đúng định dạng email',

        ];
    }
}
