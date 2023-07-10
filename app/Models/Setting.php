<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


/**
 * Class Setting
 *
 * @property $id
 * @property $email
 * @property $phone
 * @property $address
 * @property $city
 * @property $twitter_url
 * @property $linkedin_url
 * @property $facebook_url
 * @property $instagram_url
 * @property $pinterest_url
 * @property $youtube_url
 * @property $email_contacts
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Setting extends Model implements HasMedia, TranslatableContract
{
  use HasFactory;
  use Translatable;
  
  use InteractsWithMedia;

  public $translatedAttributes = ['text']; 

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['email','phone','address','city', 'postalcode', 'twitter_url','linkedin_url','facebook_url','instagram_url','pinterest_url','youtube_url','email_contacts'];

    public function medias()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    // public function registerMediaConversions(Media $media = null): void
    // {
    //     $this->addMediaConversion('thumb')
    //           ->width(300)
    //           ->nonOptimized() //for shared hosts
    //           ->nonQueued(); //for shared hosts
    // }


}
