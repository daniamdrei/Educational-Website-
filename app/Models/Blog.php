<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Blog extends Model
{
    use SoftDeletes , Translatable;

    public $translatedModel = BlogTranslation::class;
    public $translatedAttributes = ['title' , 'content'];
    protected $fillable=[
        'is_active',
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
                ->orwhereTranslationLike('content', 'like', '%' . $query['generalSearch'] . '%');
        }
    }
}
