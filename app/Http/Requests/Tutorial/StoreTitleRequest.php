<?php

namespace App\Http\Requests\Tutorial;

use Illuminate\Foundation\Http\FormRequest;

class StoreTitleRequest extends FormRequest
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
            'title_name' => 'required',
            'prologue' => 'required|max:500',
            'category_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'title_name.required' => "Kolom title tidak boleh kosong.",
            'prologue.required' => "Prologue harus terisi.",
            'category_id' => "Category harus dipilih salah satu."
        ];
    }
}