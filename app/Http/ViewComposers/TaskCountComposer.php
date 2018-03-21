<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;

/**
* 
*/
class TaskCountComposer
{

/*    function __construct(argument)
    {

    }*/

    public function compose(View $view)
    {
        $view->with([
            'total' => 20,
            'toDoCount' => 10,
            'doneCount' => 10,
        ]);
    }
}