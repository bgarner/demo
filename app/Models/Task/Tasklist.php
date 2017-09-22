<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;

class Tasklist extends Model
{
    protected $table = 'tasklists';

    protected $fillable = ['title', 'description', 'due_date', 'publish_date'];

    public static function getTasklists()
    {
    	return Tasklist::all();
    }
}
