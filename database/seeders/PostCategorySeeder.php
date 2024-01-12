<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostCategory::create([
            'post_category_name' => 'Board of Regents',
            'post_category_detail' => 'Boards'
        ]);

        PostCategory::create([
            'post_category_name' => 'The President',
            'post_category_detail' => 'The president'
        ]);

        PostCategory::create([
            'post_category_name' => 'Vice Presidents and Asst. Vice Presidents',
            'post_category_detail' => 'Vice Presidents and Asst. Vice Presidents'
        ]);
        
        PostCategory::create([
            'post_category_name' => 'Directors and Chiefs',
            'post_category_detail' => 'Directors and Chiefs'
        ]);

        PostCategory::create([
            'post_category_name' => 'Deans',
            'post_category_detail' => 'Deans'
        ]);

        PostCategory::create([
            'post_category_name' => 'Organizational Chart',
            'post_category_detail' => 'Organizational Chart'
        ]);
        
        PostCategory::create([
            'post_category_name' => 'Board Exam Passers',
            'post_category_detail' => 'Board Exam Passers'
        ]);

        PostCategory::create([
            'post_category_name' => 'Graduates',
            'post_category_detail' => 'Graduates'
        ]);

        PostCategory::create([
            'post_category_name' => 'Undergraduate Programs',
            'post_category_detail' => 'Undergraduate Programs'
        ]);

        PostCategory::create([
            'post_category_name' => 'Announcements',
            'post_category_detail' => 'Announcements'
        ]);

        PostCategory::create([
            'post_category_name' => 'Newsletter',
            'post_category_detail' => 'Newsletter'
        ]);

        PostCategory::create([
            'post_category_name' => 'Message from the University President',
            'post_category_detail' => 'Message from the University President'
        ]);

        PostCategory::create([
            'post_category_name' => 'Job Openings/Careers',
            'post_category_detail' => 'Job Openings/Careers'
        ]);

        PostCategory::create([
            'post_category_name' => 'Campus Events',
            'post_category_detail' => 'Campus Events'
        ]);

        PostCategory::create([
            'post_category_name' => 'Alumni News & Updates',
            'post_category_detail' => 'Alumni News & Updates'
        ]);

        PostCategory::create([
            'post_category_name' => 'Downloads',
            'post_category_detail' => 'Downloads'
        ]);

    }
}
