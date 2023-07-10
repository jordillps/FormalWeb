<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

/**
 * Class Category
 *
 * @property $id
 * @property $created_at
 * @property $updated_at
 *
 * @property Post[] $posts
 * @property Project[] $projects
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Category extends Model{

    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['name', 'url'];
    
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'category_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany('App\Models\Project', 'category_id', 'id');
    }
    

}
