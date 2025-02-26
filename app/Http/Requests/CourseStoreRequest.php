<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseStoreRequest extends FormRequest
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
            'cg_id' => 'required',
            'gallery_id' => 'required',
            'text' => 'required',
            'full_text' => 'required',
            'description' => 'required',
            'keywords' => 'required',
            'source' => 'required',
            'date' => 'required',
            'icon' => 'required',
            'thumbnail' => 'required',
            'header_image' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'teacher' => 'required',
            'link' => 'required',
        ];
    }
}
