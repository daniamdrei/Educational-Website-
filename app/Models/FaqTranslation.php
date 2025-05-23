<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqTranslation extends Model
{
    protected $fillable = ['title', 'answer'];
    public $timestamps = false;
}
