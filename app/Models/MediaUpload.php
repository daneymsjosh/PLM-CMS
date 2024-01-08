<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'media_type_id',
        'media_name',
        'caption_title',
        'caption_description'
    ];

    public function mediaType()
    {
        return $this->belongsTo(MediaType::class, 'media_type_id', 'id');
    }

    public function contents()
    {
        return $this->belongsToMany(Content::class, 'content_media');
    }
}
