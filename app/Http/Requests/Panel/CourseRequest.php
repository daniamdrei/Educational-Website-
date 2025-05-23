<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
        $rules = [
            'image' => $this->method() == "POST" ? 'required|image' : 'nullable|image',
        ];
        foreach (locales() as $key=>$lang){
            $rules['title_'.$key] = 'required|string|max:255';
            $rules['description_'.$key] = 'required|string';
            $rules['category_'.$key] = 'required|string|max:255';
            $rules['instructor_'.$key] = 'required|string|max:255';
        }

        return  $rules;
    }

    public function attributes()
    {
        $attrs = [
            'image' => __('constants.image')
        ];
        foreach (locales() as $key=>$lang){
            $attrs['title_'.$key] = __('panel.title') . '('. $lang['name'] .')';
            $attrs['description_'.$key] = __('panel.description') . '('. $lang['name'] .')';
            $attrs['category_'.$key] = __('panel.category') . '('. $lang['name'] .')';
            $attrs['instructor_'.$key] = __('panel.instructor') . '('. $lang['name'] .')';
        }

        return  $attrs;
    }
}
