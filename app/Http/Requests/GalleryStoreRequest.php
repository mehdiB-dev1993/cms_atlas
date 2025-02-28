<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryStoreRequest extends FormRequest
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
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'abstract' => 'required',
            'text' => 'required',
            'keywords' => 'required',
            'icon' => 'required',
            'thumbnail' => 'required',
            'header_image' => 'required',
            'order' => 'required',
            'item' => 'required',
        ];
    }


}
