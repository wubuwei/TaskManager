<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Task;
use Redirect;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Repositories\TasksRepository;
use Auth;
use App\Project;

class TasksController extends Controller
{
    protected $task;

    public function __construct(TasksRepository $task)
    {
        $this->task = $task;
    }

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
        $task = Task::findOrFail($id);
        return view('tasks.details', compact('task'));
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

    public function charts()
    {
        $total = $this->task->total(); //调用taskRepository类的方法
        $toDoCount = $this->task->toDoCount();
        $doneCount = $this->task->doneCount();
        $projects = Project::with('tasks')->get(); //使用with指定模型里对应好的关系，get获取所有项目分别对下应得任务数据
        //$projects = Project::get(); //不需要使用with指定也可以 //radar图时此处就不行了
        $names = Project::lists('name');  //取出name字段列的所有值
        return view('tasks.charts', compact('total', 'toDoCount', 'doneCount', 'names', 'projects'));
    }
}

