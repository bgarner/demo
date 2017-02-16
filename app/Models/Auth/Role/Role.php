<?php

namespace App\Models\Auth\Role;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    
    protected $fillable = ['role_name'];
}
