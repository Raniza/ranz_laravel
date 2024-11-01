<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class ProjectContentStoreRequest extends FormRequest
{
    protected $errorBag = "pjContentsErrors";
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
            'project_id' => 'required',
            'sub_title' => 'required',
            'contents' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'project_id.required' => 'Pilih salah satu project title.',
            'sub_title.required' => 'Sub title tidak boleh kosong.',
            'contents.required' => 'Contents tidak boleh kosong',
        ];
    }
}
