<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseTranslation extends Model
{
   protected $fillable = ['title', 'description', 'instructor', 'category'];
    public $timestamps = false;
}
