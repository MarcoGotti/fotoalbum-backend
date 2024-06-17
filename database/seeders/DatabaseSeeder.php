<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Photo;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //I have not migrated and seeded in the same time. I have chosen to go step by step for a deeper understanding

        $this->call([
            Photo::class,
            Category::class,
        ]);
    }
}
