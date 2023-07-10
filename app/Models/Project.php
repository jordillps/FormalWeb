<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

/**
 * Class Project
 *
 * @property $id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Project extends Model  implements HasMedia, TranslatableContract{

    use HasFactory;
    use Translatable;

    use InteractsWithMedia;

    public $translatedAttributes = ['title', 'text','period-time'];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['published_at','category_id','url', 'company', 'location','projectLink', 'isPublished'];


    function getRouteKeyName(){
        return 'url';
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function category(){
        
        return $this->belongsTo(Category::class);
    }

    public function medias(){
        return $this->morphMany(Media::class, 'mediable');
    }

    // public function registerMediaConversions(Media $media = null): void
    // {
    //     $this->addMediaConversion('thumb')
    //           ->width(960)
    //           ->nonOptimized() //for shared hosts
    //           ->nonQueued(); //for shared hosts;
    // }

}
