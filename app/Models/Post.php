<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $with = ['tags', 'category', 'user'];

    /**
     * deleteImage post
     *
     * @return void
     */
    public function deleteImage()
    {
        Storage::delete($this->image);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * check if post has tag
     *
     * @param  mixed $tags
     * @return void
     */
    public function hasTag($tags)
    {
        return in_array($tags, $this->tags()->pluck('id')->toArray());
    }

    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * showImage
     *
     * @return void
     */
    public function getPhotoAttribute()
    {
        return $this->image ? asset("storage/{$this->image}") : asset('storage/images/default-photo.jpg');
    }

    /**
     * scopeSearched
     *
     * @param  mixed $query
     * @return void
     */
    public function scopeSearched($query)
    {
        $search = request()->query('q');
        if(!$search){
            return $query->latest();
        }

        return $query->where('title', 'LIKE', "%{$search}%");
    }
}
