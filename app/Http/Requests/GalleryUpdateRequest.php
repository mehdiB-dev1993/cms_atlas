<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryUpdateRequest extends FormRequest
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
            'item_src'=> 'required',
            'item_alt'=> 'required',
            'item_description'=> 'required',
            'item_link'=> 'required',
            'item_order'=> 'required'
        ];

    }
}
