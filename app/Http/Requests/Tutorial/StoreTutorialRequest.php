<?php

namespace App\Http\Requests\Tutorial;

use Illuminate\Foundation\Http\FormRequest;

class StoreTutorialRequest extends FormRequest
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
            'title_id' => 'required',
            'sub_title' => 'required',
            'contents' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'title_id.required' => 'Title harus dipilih salah satu.',
            'sub_title.required' => 'Sub title tidak boleh kosong.',
            'contents.required' => 'Contents tidak boleh kosong.'
        ];
    }
}
