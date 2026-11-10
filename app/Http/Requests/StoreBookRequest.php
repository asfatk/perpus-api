<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'BookRequest',
    required: ['title', 'author', 'isbn', 'published_year', 'stock'],
    properties: [
        new OA\Property(
            property: 'title',
            type: 'string',
            example: 'Pemrograman Laravel 12'
        ),
        new OA\Property(
            property: 'author',
            type: 'string',
            example: 'Budi Santoso'
        ),
        new OA\Property(
            property: 'publisher',
            type: 'string',
            nullable: true,
            example: 'Informatika'
        ),
        new OA\Property(
            property: 'isbn',
            type: 'string',
            example: '9786021234567'
        ),
        new OA\Property(
            property: 'published_year',
            type: 'integer',
            example: 2025
        ),
        new OA\Property(
            property: 'stock',
            type: 'integer',
            example: 10
        ),
        new OA\Property(
            property: 'description',
            type: 'string',
            nullable: true,
            example: 'Buku panduan belajar Laravel.'
        ),
    ]
)]

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'publisher' => ['nullable', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:20', 'unique:books,isbn'],
            'published_year' => ['required', 'integer', 'min:1000', 'max:'.date('Y')],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ];
    }
}
