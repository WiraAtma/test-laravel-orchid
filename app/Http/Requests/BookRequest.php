<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'book.name' => 'required|min:3|max:250',
            'book.author' => 'required|min:3|max:250',
            'book.description' => 'required|min:3',
            'book.year' => 'required|min:2|max:4',
        ];
    }

    public function messages()
    {
        return [
            'book.name.required' => 'Judul Wajib Diisi',
            'book.name.min' => 'Judul Minimal :min Karakter',
            'book.name.max' => 'Judul Maksimal :max Karakter',
            'book.author.required' => 'Penulis Wajib Diisi',
            'book.author.min' => 'Penulis Minimal :min Karakter',
            'book.author.max' => 'Penulis Maksimal :max Karakter',
            'book.description.required' => 'Penulis Wajib Diisi',
            'book.description.min' => 'Penulis Minimal :min Karakter',
            'book.year.required' => 'Tahun Wajib Diisi',
            'book.year.min' => 'Tahun Minimal :min Karakter',
            'book.year.max' => 'Tahun Maksimal :max Karakter',
        ];
    }
}
