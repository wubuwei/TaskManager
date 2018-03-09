<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $fillable = [
		'title','project_id','completed'
	];

    public function project()
    {
    	//$project->tasks()
    	//$task->project()
    	return $this->belongsTo('App\Project');
    }

    //使用模型关系绑定，在blade的form中绑定了模型，可以通过此来获取到此方法的返回值
    public function getProjectListAttribute()
    {
    	//project()调用的是关系，project->id获取具体的当前项目
    	return $this->project->id;
    }
}
