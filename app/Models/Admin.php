<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use SoftDeletes , HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'remember_token'
    ];

    protected $hidden=['password' , 'remember_token'];
}
