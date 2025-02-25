<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageStoreRequest extends FormRequest
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
            'title_in_menu' => 'required',
            'menu_id' => 'required',
            'text' => 'required',
            'full_text' => 'required',
            'description' => 'required',
            'keywords' => 'required',
            'source' => 'required',
            'date' => 'required',
            'status' => 'required',
            'page_icon' => 'required',
            'thumbnail' => 'required',
            'header_image' => 'required',
        ];
    }


/*    public function messages(): array
    {
        return [
            'full_page_name.required' => 'فیلد عنوان کامل صفحه الزامی میباشد!',
            'page_name_in_menu.required' => 'فیلد عنوان صفحه در منو الزامی میباشد!',
            'menu_id.required' => 'فیلد انتخاب منو الزامی میباشد!',
            'text.required' => 'فیلد خلاصه متن الزامی میباشد!',
            'full_text.required' => 'فیلد متن کامل الزامی میباشد!',
            'description.required' => 'فیلد توضیحات الزامی میباشد!',
            'keywords.required' => 'فیلد کلمات کلیدی الزامی میباشد!',
            'source.required' => 'فیلد لینک منبع الزامی میباشد!',
            'date.required' => 'فیلد تاریخ الزامی میباشد!',
            'status.required' => 'فیلد وضعیت الزامی میباشد!',
            'page_icon.required' => 'فایل آیکون صفحه بارگذاری نشده است!',
            'thumb.required' => 'فایل تصویر بند انگشتی بارگذاری نشده است!',
            'header_image.required' => 'فایل تصویر هدر بارگذاری نشده است!',
            'gallery_image.required' => 'فیلد تصاویر گالری بارگذاری نشده است!',

        ];
    }*/
}
