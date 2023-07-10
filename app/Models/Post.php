<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;

/**
 * Class Post
 *
 * @property $id
 * @property $title
 * @property $url
 * @property $excerpt
 * @property $iframe
 * @property $body
 * @property $published_at
 * @property $user_id
 * @property $category_id
 * @property $isPublished
 * @property $created_at
 * @property $updated_at
 *
 * @property Category $category
 * @property Comment[] $comments
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Post extends Model implements HasMedia, TranslatableContract
{
    use HasFactory;
    use Translatable;

    use InteractsWithMedia;

    protected $dates = ['published_at'];

    public $translatedAttributes = ['title','excerpt', 'iframe','body'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['published_at','user_id','category_id', 'isPublished','url'];

    function getRouteKeyName(){
        return 'url';
    }


     /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'post_id', 'id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medias()
    {
        return $this->morphMany(Media::class, 'mediable');
    }


}
