<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Task;
use Redirect;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Auth;
use App\Project;

class TasksController extends Controller
{

    public function index()
    {
        $toDo = Auth::user()->tasks()->where('completed', 0)->paginate(3);
        $Done = Auth::user()->tasks()->where('completed', 1)->paginate(3);
        $projects = Project::lists('name', 'id');
        return view('tasks.index', compact('toDo', 'Done', 'projects'));
    }


    public function create()
    {
        //
    }


    public function store(CreateTaskRequest $request)
    {
        Task::create([
            'title' => $request->name,
            'project_id' => $request->project_id
        ]);

        return Redirect::back();
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->title = $request->title;
        $task->project_id = $request->projectList;
        $task->save();

        return Redirect::back();
    }

    public function check($id)
    {
        $task = Task::findOrFail($id);
        $task->completed = 1;
        $task->save();
        return Redirect::back();
    }



    public function destroy($id)
    {
        Task::find($id)->delete();

        return Redirect::back();
    }
}
