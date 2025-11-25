<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $bookId = $this->route('book')?->id ?? null;

        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:1',
            'isbn' => 'nullable|string|max:255|unique:books,isbn,' . $bookId,
            'description' => 'nullable|string',
            'published_year' => 'nullable|integer',
            'publisher' => 'nullable|string|max:255',
        ];
    }
}
