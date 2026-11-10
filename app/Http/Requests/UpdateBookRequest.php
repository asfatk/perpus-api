<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'UpdateBookRequest',
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

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'author' => ['sometimes', 'required', 'string', 'max:255'],
            'publisher' => ['sometimes', 'nullable', 'string', 'max:255'],

            'isbn' => [
                'sometimes',
                'required',
                'string',
                'max:20',
                Rule::unique('books', 'isbn')->ignore($this->route('book')),
            ],

            'published_year' => [
                'sometimes',
                'required',
                'integer',
                'min:1000',
                'max:' . date('Y'),
            ],

            'stock' => [
                'sometimes',
                'required',
                'integer',
                'min:0',
            ],

            'description' => [
                'sometimes',
                'nullable',
                'string',
            ],
        ];
    }
}
