<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class ProjectStoreRequest extends FormRequest
{
    protected $errorBag = "projectErrors";
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
            'prologue' => 'required|max:500',
            'category_id' => 'required',
            'desc' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => "Kolom title tidak boleh kosong.",
            'prologue.required' => "Prologue harus terisi.",
            'category_id' => "Category harus dipilih salah satu.",
            'desc' => "Description tidak boleh kosong."
        ];
    }

}
