<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create([
            'tag_name' => 'Computer Science',
            'tag_detail' => 'About Computer Science',
        ]);

        Tag::create([
            'tag_name' => 'Gaming',
            'tag_detail' => 'About Gaming',
        ]);

        Tag::create([
            'tag_name' => 'Exams',
            'tag_detail' => 'About Exams',
        ]);

        Tag::create([
            'tag_name' => 'Lifestyle',
            'tag_detail' => 'About Lifestyle',
        ]);

        Tag::create([
            'tag_name' => 'Grades',
            'tag_detail' => 'About Grades',
        ]);

        Tag::create([
            'tag_name' => 'Professors',
            'tag_detail' => 'About Professors',
        ]);

        Tag::create([
            'tag_name' => 'Sports',
            'tag_detail' => 'About Sports',
        ]);

        Tag::create([
            'tag_name' => 'Research',
            'tag_detail' => 'About Research',
        ]);
    }
}
