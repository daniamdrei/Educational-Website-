<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Course extends Model
{
     use SoftDeletes, Translatable;

    public $translationModel = CourseTranslation::class;
    public $translatedAttributes = ['title', 'description', 'instructor', 'category'];
    protected $fillable = ['is_active', 'image'];

    public function createTranslation(Request $request)
    {
        foreach (locales() as $key => $language) {
            foreach ($this->translatedAttributes as $attribute) {
                if ($request->get($attribute . '_' . $key) != null && !empty($request->$attribute . $key)) {
                    $this->{$attribute . ':' . $key} = $request->get($attribute . '_' . $key);
                }
            }
            $this->save();
        }
        return $this;
    }

    public function scopeFilter($q)
    {
        $request = request();
        $query = $request->get('query', []);

        if (isset($query['generalSearch'])) {
            $q->whereTranslationLike('title', 'like', '%' . $query['generalSearch'] . '%')
                ->orwhereTranslationLike('description', 'like', '%' . $query['generalSearch'] . '%')
                ->orwhereTranslationLike('instructor', 'like', '%' . $query['generalSearch'] . '%')
                ->orwhereTranslationLike('category', 'like', '%' . $query['generalSearch'] . '%');
        }
    }

    // public function lectures()
    // {
    //     return $this->hasMany(Lecture::class);
    // }


    // public function subscriptions()
    // {
    //     return $this->hasMany(Subscription::class);
    // }

    // public function students()
    // {
    //     return $this->hasManyThrough(Student::class, Subscription::class);
    // }
}
