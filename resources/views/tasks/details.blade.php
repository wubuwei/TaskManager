@extends('layouts.app')

@section('customHeader')
    <meta name="token" id="token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div id="app" class="container">
        <h1 class="text-muted">{{ $task->title }}</h1>

        <div class="col-md-4 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 v-if="remaings.length">
                        待完成的步骤(@{{ remaings.length }})
                        <span class="btn btn-sm btn-info" @click="completeAll">完成所有</span>
                    </h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <step-list  v-for="(step,index) in inProcess" :step="step" @edit="editStep(step)"
                                    @toggle="toggleCompletion(step)" @remove="removeStep(step)"></step-list>
                    </ul>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <form @submit.prevent="addStep" class="form">
                        <div class="form-group">
                            <label v-if="! newStep">完成该任务(Task)需要哪些步骤(Step)呢?</label>
                            <input type="text" v-model="newStep" ref="newStep" class="form-control" placeholder="I need to ...">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" v-if="newStep">添加步骤</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 v-show="completions.length">
                        已完成的步骤(@{{ completions.length }})
                        <span class="btn btn-sm btn-danger" @click="clearCompleted">清除所有已完成</span>
                    </h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <step-list  v-for="(step,index) in processed" :step="step"
                                    @toggle="toggleCompletion(step)" @remove="removeStep(step)"></step-list>
                    </ul>
                </div>
            </div>
        </div>

        {{--vue2中全局变量$data本身即是json格式，vue1的写法为 @{{ $data | json }}--}}
       {{--<pre>@{{ $data }}</pre>--}}{{--@{{ $data }}--}}

    </div>
@endsection

@section('customJS')
    <script src="{{ asset('js/app.js') }}"></script>
{{--    <script src="{{ asset('js/vue.js') }}"></script>
    <script src="{{ asset('js/vue-resource.js') }}"></script>
    <script>

    </script>--}}
@endsection