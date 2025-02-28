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
            'name' => 'required',
            'title' => 'required',
            'menu_id' => 'required',
            'abstract' => 'required',
            'text' => 'required',
            'description' => 'required',
            'keywords' => 'required',
            'source_link' => 'required',
            'published_at' => 'required',
            'order' => 'required',
            'status' => 'required',
            'icon' => 'required',
            'thumbnail' => 'required',
            'header_image' => 'required',
            'attached_file' => 'required',
        ];
    }


}
