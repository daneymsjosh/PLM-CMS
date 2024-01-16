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
            'tag_name' => 'PLM',
            'tag_detail' => 'Pamantasan',
        ]);

        Tag::create([
            'tag_name' => 'Activities',
            'tag_detail' => 'About Activities',
        ]);

        Tag::create([
            'tag_name' => 'Students',
            'tag_detail' => 'About Students',
        ]);

        Tag::create([
            'tag_name' => 'University Updates',
            'tag_detail' => 'About University Updates',
        ]);

        Tag::create([
            'tag_name' => 'Faculty',
            'tag_detail' => 'About Faculty Members',
        ]);

        Tag::create([
            'tag_name' => 'Events',
            'tag_detail' => 'About Events',
        ]);

        Tag::create([
            'tag_name' => 'Research',
            'tag_detail' => 'About Research',
        ]);

        Tag::create([
            'tag_name' => 'CAT:About',
            'tag_detail' => 'About',
        ]);

        Tag::create([
            'tag_name' => 'CAT:Admission',
            'tag_detail' => 'Admission',
        ]);

        Tag::create([
            'tag_name' => 'CAT:News',
            'tag_detail' => 'News',
        ]);

        Tag::create([
            'tag_name' => 'CAT:Students',
            'tag_detail' => 'Students',
        ]);

        Tag::create([
            'tag_name' => 'CAT:Community',
            'tag_detail' => 'Community',
        ]);

        Tag::create([
            'tag_name' => 'CAT:Alumni',
            'tag_detail' => 'Alumni',
        ]);
    }
}
