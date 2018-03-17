<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $fillable = [
		'name', 'thumbnail'
	];

    public function user()
    {
    	// $project->user()
    	return $this->belongsTo('App\User');
    }

    public function tasks()
    {
    	return $this->hasMany('App\Task');
    }

    public function getThumbnailAttribute($value)
    {
        //相比于注释掉，此段代码更加简洁，省去了代码行数
        if (!$value) {
            return 'flower.jpg';
        }        
        return $value;

/*        if ($value) {
            return $value;
        } else {
            return 'flower.jpg';
        }*/
    }
}
