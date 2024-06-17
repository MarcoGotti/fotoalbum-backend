<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdatePhotoRequest extends FormRequest
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
            //'title' => 'required|unique:photos,title|min:3|max:30',
            'title' => ['required', 'min:3', 'max:30', Rule::unique('photos')->ignore($this->photo->id)],
            'upload' => ['required', 'max:300', Rule::unique('photos')->ignore($this->photo->id)],
            'description' => 'nullable|min:20'
        ];
    }
}
