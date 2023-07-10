<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

/**
 * Class Title
 *
 * @property $id
 * @property $page_id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Title extends Model implements TranslatableContract{
    
  use HasFactory;
  use Translatable;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['page_id'];

    public $translatedAttributes = ['title','text'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function page(){
      return $this->belongsTo(Page::class);
  }


}
