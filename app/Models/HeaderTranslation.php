<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['header_id','locale', 'title', 'text'];
}
