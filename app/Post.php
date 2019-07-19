<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
class Post extends Model
{
    protected $fillable = [
        'title', 'description', 'published_at', 'content', 'image'
    ];

    use SoftDeletes;

    public function deleteImage() {
        Storage::delete($this->image);
    }
}
