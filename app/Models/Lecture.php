<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Lecture extends Model
{
    use  Translatable;
    public $translationModel = LectureTranslation::class;
    public $translatedAttributes = ['title', 'description'];
    protected $fillable = ['is_active' , 'video_link' , 'course_id'];

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
            $q->whereTranslationLike('title', '%' . $query['generalSearch'] . '%')
                ->orwhereTranslationLike('description',  '%' . $query['generalSearch'] . '%');
        }
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
