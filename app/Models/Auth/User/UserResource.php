<?php

namespace App\Models\Auth\User;

use Illuminate\Database\Eloquent\Model;

class UserResource extends Model
{
    protected $table = 'user_resource';

    protected $fillable = ['user_id', 'resource_id'];

}
