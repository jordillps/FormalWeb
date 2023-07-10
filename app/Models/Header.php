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
 * Class Header
 *
 * @property $id
 * @property $page_id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Header extends Model implements HasMedia, TranslatableContract
{
  use HasFactory;
  use Translatable;

  use InteractsWithMedia;


  public $translatedAttributes = ['title','text'];

  /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['page_id'];

    
    // protected $perPage = 20;

  /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function medias()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    // public function registerMediaConversions(Media $media = null): void
    // {
    //     $this->addMediaConversion('thumb')
    //           ->width(1920)
    //           ->nonOptimized() //for shared hosts
    //           ->nonQueued(); //for shared hosts;
    // }


}
