<?php

namespace Database\Seeders;

use App\Models\PostStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostStatus::create([
            'post_status_name' => 'For Approval',
            'post_status_detail' => 'Waiting for approval from super admin',
        ]);

        PostStatus::create([
            'post_status_name' => 'Approved',
            'post_status_detail' => 'Post approved by super admin',
        ]);

        PostStatus::create([
            'post_status_name' => 'For Revision',
            'post_status_detail' => 'Needs revision to be approved by super admin',
        ]);

        PostStatus::create([
            'post_status_name' => 'Rejected',
            'post_status_detail' => 'Post is rejected by super admin',
        ]);
    }
}
