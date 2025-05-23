<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
        $rules = [];
        foreach (locales() as $key=>$lang){
            $rules['title_'.$key] = 'required|string|max:255';
            $rules['answer_'.$key] = 'required|string|max:255';
        }

        return  $rules;
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
