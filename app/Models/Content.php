<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_body'
    ];

    public function mediaUploads()
    {
        return $this->belongsToMany(MediaUpload::class, 'content_media');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'content_id', 'id');
    }
}
