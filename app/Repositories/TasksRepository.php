<?php
namespace App\Repositories;

use App\Task;

class TasksRepository
{
	public function total()
	{
		$total = auth()->user()->tasks()->count();
		return $total;
	}

	public function doneCount()
	{
		$doneCount = auth()->user()->tasks()->where('completed', 1)->count();
		return $doneCount;
	}

	public function toDoCount()
	{
		$toDoCount = auth()->user()->tasks()->where('completed', 0)->count();
		return $toDoCount;
	}
}