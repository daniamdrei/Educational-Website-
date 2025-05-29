<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes ;

    protected $fillable=[
        'name',
        'email',
        'password',
        'ssn_id',
    ];

    public function scopeFilter($q)
    {
        $request = request();
        $query = $request->get('query', []);

        if (isset($query['generalSearch'])) {
            $q->where('name', 'like', '%' . $query['generalSearch'] . '%')
                ->orWhere('email', 'like', '%' . $query['generalSearch'] . '%')
                ->orWhere('ssn_id', 'like', '%' . $query['generalSearch'] . '%');
        }
    }


    public function subscriptions(){
        return $this->belongsToMany(Subscription::class);
    }

    public function courses(){
        return $this->hasManyThrough(Course::class , Subscription::class);
    }
}
