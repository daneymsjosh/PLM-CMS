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
            'post_category_name' => 'About',
            'post_category_detail' => 'General information about PLM'
        ]);

        PostCategory::create([
            'post_category_name' => 'Academics',
            'post_category_detail' => 'Academic branches within the university'
        ]);

        PostCategory::create([
            'post_category_name' => 'Admissions',
            'post_category_detail' => 'Details about the admission tests in PLM'
        ]);
        
        PostCategory::create([
            'post_category_name' => 'News',
            'post_category_detail' => 'News and university announcement'
        ]);
    }
}
