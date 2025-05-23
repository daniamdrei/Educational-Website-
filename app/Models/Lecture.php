<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Lecture extends Model
{
     public $translatedModel = LectureTranslation::class;
    public $translatedAttributes = ['title' ,'description'];
    protected $fillable=[
        'is_active',
        'course_id',
        'video_link'
    ];

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
            ->whereTranslationLike('description', 'like', '%' . $query['generalSearch'] . '%');
        }
    }
}
