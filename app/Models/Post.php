<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public const ForApproval = 1;
    public const Approved = 2;
    public const ForRevision = 3;
    public const Rejected = 4;


    protected $fillable = [
        'post_category_id',
        'post_status_id',
        'content_id',
        'post_title',
        'schedule_posting',
        'created_by_id',
        'modified_by_id',
        'remarks'
    ];

    public function category() {
        return $this->belongsTo(PostCategory::class, 'post_category_id', 'id');
    }

    public function status() {
        return $this->belongsTo(PostStatus::class, 'post_status_id', 'id');
    }

    public function content() {
        return $this->belongsTo(Content::class, 'content_id', 'id');
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }

    public function modifiedBy() {
        return $this->belongsTo(User::class, 'modified_by_id', 'id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}
