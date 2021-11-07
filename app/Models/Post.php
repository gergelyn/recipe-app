<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body'
    ];

    public function cover_image() {
        return $this->hasOne('App\PostCoverImage');
    }
}
