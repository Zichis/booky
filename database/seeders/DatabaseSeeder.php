<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (count(Book::all()) < 1) {
            Book::factory()
                ->count(10)
                ->create();
        }
    }
}
