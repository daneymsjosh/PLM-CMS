<?php

namespace Database\Seeders;

use App\Models\MediaType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediaTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MediaType::create([
            'media_type_name' => 'Image',
            'media_type_detail' => 'Files that are jpg, png, etc'
        ]);
    }
}
