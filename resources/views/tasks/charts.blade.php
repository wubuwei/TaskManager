@extends('layouts.app')

@section('content')
    <div class="container col-md-4">
        <canvas id="pieChart" width="300" height="300"></canvas>
        <div id="pie-data" data-todo="{{ $toDoCount }}" data-done="{{ $doneCount }}"data-total="{{ $total }}"></div>
    </div>
    <div class="container col-md-4">
        <canvas id="barChart" width="300" height="300"></canvas>
        <div id="bar-data"
        data-names={!! json_encode($names, JSON_UNESCAPED_UNICODE) !!}
        data-counts={!! json_encode(TasksCountArray($projects)) !!}
        ></div>
    </div>




@endsection

@section('customJS')
    <script src="{{ asset('js/charts.js') }}"></script>
@endsection