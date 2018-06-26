@extends('layouts.app')

@section('customHeader')
    <meta name="token" id="token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div id="app" class="container">
        <h1 class="text-muted">{{ $task->title }}</h1>

        <step-list :steps="steps" @toggle="toggleCompletion" @remove="removeStep"
                   @new="addStep" @complete="completeAll" type="remaings"></step-list>

        <step-list :steps="steps" @toggle="toggleCompletion" @remove="removeStep"
                    @clear="clearCompleted" type="completed"></step-list>

    </div>
@endsection

@section('customJS')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection