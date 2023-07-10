<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitleTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['title_id','locale', 'title', 'text'];

}
