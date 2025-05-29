<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'student_id','course_id','start_data','end_data','is_active'
    ];

     public function scopeFilter($q)
    {
        $request = request();
        $query = $request->get('query', []);

        if (isset($query['course_id'])){
            $q->where('course_id', $query['course_id']);
        }

        if (isset($query['student_id'])){
            $q->where('student_id', $query['student_id']);
        }
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
