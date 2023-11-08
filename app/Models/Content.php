<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'media_upload_id',
        'content_body'
    ];

    public function mediaUpload() {
        return $this->belongsTo(MediaUpload::class, 'media_upload_id', 'id');
    }
}
