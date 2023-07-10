<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalPageTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['legal_page_id','title','locale','body'];

}
