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
 * Class Service
 *
 * @property $id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Service extends Model implements HasMedia, TranslatableContract{
    
    use HasFactory;
    use Translatable;

    use InteractsWithMedia;

  

  public $translatedAttributes = ['title','text','body'];

  /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['icon'];


    public function medias(){
        return $this->morphMany(Media::class, 'mediable');
    }


}
