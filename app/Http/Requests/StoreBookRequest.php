<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Untuk tugas kuliah, ijinkan semua yang sudah ter-auth;
        // jika perlu, ganti dengan policy / gate.
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:1',
            'isbn' => 'nullable|string|max:255|unique:books,isbn',
            'description' => 'nullable|string',
            'published_year' => 'nullable|integer',
            'publisher' => 'nullable|string|max:255',
        ];
    }
}
