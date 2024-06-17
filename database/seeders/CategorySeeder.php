<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = config('photos.categories');

        foreach ($categories as $cat) {
            $newcat = new Category();
            $newcat->name = ucfirst($cat);
            $newcat->slug = Str::of($cat)->slug('-');
            $newcat->save();
        }
    }
}
