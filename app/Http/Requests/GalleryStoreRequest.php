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
            'title' => 'required',
            'description' => 'required',
            'item_alt' => 'required',
            'item_description' => 'required',
            'item_link' => 'required',
            'status' => 'required',
            'thumbnail' => 'required',
            'item' => 'required',
        ];
    }

 /*   public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
        ];
    }*/
}
