<?php

namespace Database\Seeders;

use App\Models\Photo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $photos = config('photos.photos');

        foreach ($photos as $photo) {
            $newPhoto = new Photo();
            $newPhoto->title = $photo['title'];
            $newPhoto->description = $photo['description'];
            $newPhoto->upload = $photo['upload'];
            $newPhoto->slug = Str::of($photo['title'])->slug('-');
            $newPhoto->save();
        }
    }
}
