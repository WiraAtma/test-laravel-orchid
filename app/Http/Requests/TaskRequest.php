<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'task.name' => 'required|min:3|max:255',
            'task.price' => 'required|min:1|max:100',
        ];
    }

    public function messages()
    {
        return [
            'task.name.min' => 'Nama Harus Minimal :min Karakter',
            'task.name.max' => 'Nama Maksimal :max Karakter',
            'task.price.min' => 'Harga Minimal :min Karakter',
            'task.price.max' => 'Harga Maksimal :max Karakter',
        ];
    }
}
