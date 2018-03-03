@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if($projects->count() > 0)
            @foreach($projects as $project)
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                    <a href="{{ route('projects.show', $project->name) }}">
                        <img src="{{ asset('thumbnails/' . $project->thumbnail)}}" alt="{{ $project->name }}">
                    </a>
                    <div class="caption">
                        <a href="{{ route('projects.show', $project->name) }}">
                            <h4 class="text-center">{{ $project->name }}</h4>
                        </a>
                    </div>
                </div>
            </div>  
            @endforeach
        @endif
        <div class="col-md-10 col-md-offset-1">
            @include('projects/_createProjectModal')
        </div>
    </div>
</div>
@endsection
