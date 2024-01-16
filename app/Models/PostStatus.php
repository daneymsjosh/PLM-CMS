<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostStatus extends Model
{
    use HasFactory;

    public const ForApproval = 1;
    public const Approved = 2;
    public const ForRevision = 3;
    public const Rejected = 4;
}
