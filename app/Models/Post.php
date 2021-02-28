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

    /**
     * with
     *
     * @var array
     */
    protected $with = ['tags', 'category', 'user'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'published_at',
    ];

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
     * scopePublished
     *
     * @param  mixed $query
     * @return void
     */
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now());
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
            return $query->published()->latest();
        }

        return $query->published()->where('title', 'LIKE', "%{$search}%");
    }
}
