<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'text' => 'required',
            'full_text' => 'required',
            'keywords' => 'required',
            'icon' => 'required',
            'thumbnail' => 'required',
            'header_image' => 'required',
        ];
    }

/*    public function messages(): array
    {
        return [
            'title.required' => 'فیلد عنوان منو الزامی میباشد!',
            'description.required' => 'فیلد توضیحات الزامی میباشد!',
            'text.required' => 'فیلد خلاصه متن الزامی میباشد!',
            'full_text.required' => 'فیلد متن کامل الزامی میباشد!',
            'keywords.required' => 'فیلد کلمات کلیدی الزامی میباشد!',
            'icon.required' => 'فیلد أیکون الزامی میباشد!',
            'thumb.required' => 'فیلد تصویر کوچک الزامی میباشد!',
            'header_image.required' => 'فیلد تصویر هدر سایت الزامی میباشد!',
        ];
    }*/
}
