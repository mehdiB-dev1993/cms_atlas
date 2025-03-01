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
            'abstract' => 'required',
            'text' => 'required',
            'description' => 'required',
            'keywords' => 'required',
            'source_link' => 'required',
            'icon' => 'required',
            'thumbnail' => 'required',
            'header_image' => 'required',
            'attached_file' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'duration' => 'required',
            'teacher' => 'required',
            'link' => 'required',
            'start_date' => 'required',
        ];
    }
}
