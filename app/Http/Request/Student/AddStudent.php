<?php

namespace App\Http\Request\Student;

use Illuminate\Foundation\Http\FormRequest;

class AddStudent extends FormRequest
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
            'name' => 'required|string|max:191',
            'student_code' => 'required|string|unique:students|max:20',
            'birthday' => 'required|before:today',
            'phone' => 'nullable|numeric|digits_between:10,15',
            'gender' => 'required',
            'email' => 'nullable|max:191|email',
            'score.*' => 'nullable|numeric',
            'score_special' => 'nullable|numeric',
            'term' => 'required',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Vui lòng nhập họ và tên học viên',
            'name.max' => 'Vui lòng không nhập quá 191 ký tự',

            'student_code.required' => 'Vui lòng nhập CMND hoặc Hộ chiếu',
            'student_code.numeric' => 'CMND hoặc Hộ chiếu phải là số',
            'student_code.unique' => 'Số CMND hoặc Hộ chiếu này đã tồn tại',
            'student_code.digits_between' => 'Số CMND hoặc Hộ chiếu có độ dài tối đa 20 kí tự',

            'birthday.required' => 'Vui lòng chọn ngày sinh',
            'birthday.before' => 'Ngày sinh phải trước ngày hiện tại',

            'phone.digits_between' => 'Số điện thoại tối thiếu là 10 số và tối đa là 15 số',
            'phone.numeric' => 'Vui lòng chỉ nhập số',

            'gender.required' => 'Vui lòng chọn giới tính',

            'email.max' => 'Vui lòng không nhập quá 191 ký tự',
            'email.email' => 'Vui lòng nhập đúng định dạng email',

            'score.*.numeric' => 'Vui lòng chỉ nhập số',

            'score_special' => 'Vui lòng chỉ nhập số',

            'term.required' => 'Vui lòng nhập kì thi học viên đăng kí',

        ];
    }
}
