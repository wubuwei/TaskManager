@extends('layouts.app')

@section('content')
	<div class="container tasks-tabs">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#toDo" aria-controls="profile" role="tab" data-toggle="tab">待完成</a></li>
    <li role="presentation"><a href="#Done" aria-controls="messages" role="tab" data-toggle="tab">已处理</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">

    {{-- 未完成任务列表 --}}
    <div role="tabpanel" class="tab-pane active" id="toDo">
        {{-- 所有的集合都可以作为迭代器，可以就像简单的 PHP 数组一样来遍历它们 --}}
        <table class="table table-striped">
          <thead>
            <tr>
              @include('tasks/_createForm')
            </tr>
          </thead>
            @foreach($toDo as $task)
                <tr>
                    <td class="date-cell">{{ $task->updated_at->diffForHumans() }}</td>
                    {{-- <td class="first-cell">{{ $task->title }}</td> --}}
                    <td class="first-cell">{{ link_to_route('tasks.show', $task->title, $task->id) }}</td>
                    <td class="icon-cell">@include('tasks/_checkForm')</td>
                    <td class="icon-cell">@include('tasks/_editForm')</td>
                    <td class="icon-cell">@include('tasks/_deleteForm')</td>
                </tr>
            @endforeach
        </table>
    </div>

    {{-- 已处理任务列表 --}}
    <div role="tabpanel" class="tab-pane" id="Done">
        <table class="table table-striped">
            @foreach($Done as $task)
                <tr>
                    <td>{{ $task->title }}</td>

                </tr>
            @endforeach
        </table>
    </div>

  </div>

	</div>
@endsection