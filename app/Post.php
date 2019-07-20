<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
class Post extends Model
{
    protected $fillable = [
        'title', 'description', 'published_at', 'content', 'image', 'category_id'
    ];

    use SoftDeletes;

    public function deleteImage() {
        Storage::delete($this->image);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function hasTag($tagid) {
        return in_array($tagid, $this->tags->pluck('id')->toArray());
    }
}
