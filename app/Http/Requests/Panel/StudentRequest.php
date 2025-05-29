<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'ssn_id' => 'required|numeric|unique:students,ssn_id,' . $this->route('id'),
            'email' => 'required|email|unique:students,email,' . $this->route('id'),
            'password' => 'required_if:_method,POST|nullable|string|min:8',
        ];
    }

    public function attributes()
    {
        $attrs = [];
        foreach (locales() as $key=>$lang){
            $attrs['title_'.$key] = __('panel.title') . '('. $lang['name'] .')';
            $attrs['answer_'.$key] = __('constants.answer') . '('. $lang['name'] .')';
         }

        return  $attrs;
    }
}
