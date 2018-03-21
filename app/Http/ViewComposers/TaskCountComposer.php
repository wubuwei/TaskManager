<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\TasksRepository;

/**
* 
*/
class TaskCountComposer
{

    function __construct(TasksRepository $task)
    {
        $this->task = $task;
    }

    public function compose(View $view)
    {
        if (auth()->check()) {
            $view->with([
                'total' => $this->task->total(),
                'toDoCount' => $this->task->toDoCount(),
                'doneCount' => $this->task->doneCount(),
            ]);
        }
    }
}