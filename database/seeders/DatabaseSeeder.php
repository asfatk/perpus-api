<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat akun Admin jika belum tersedia
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Perpustakaan',
                'password' => 'password',
            ]
        );

        // Membuat 20 data buku jika tabel masih kosong
        if (Book::count() === 0) {
            Book::factory(20)->create();
        }
    }
}
