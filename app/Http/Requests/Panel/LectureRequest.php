<?php

namespace App\Http\Requests\Panel;

use App\Rules\YoutubeRule;
use Illuminate\Foundation\Http\FormRequest;

class LectureRequest extends FormRequest
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
            'video_link' => [ 'required', 'url' , new YoutubeRule()],
        ];
        foreach (locales() as $key=>$lang){
            $rules['title_'.$key] = 'required|string|max:255';
            $rules['description_'.$key] = 'nullable|string';
        }

        return  $rules;
    }

    public function attributes()
    {
        $attrs = [
            'video_link' => __('panel.youtube')
        ];
        foreach (locales() as $key=>$lang){
            $attrs['title_'.$key] = __('panel.title') . '('. $lang .')';
            $attrs['description_'.$key] = __('constants.description') . '('. $lang .')';
         }

        return  $attrs;
    }
}
