@extends('layouts.app')

@section('content')
    <div id="app" class="container">
        <h1>未完成的步骤</h1>
        <ul class="list-group">
            <li class="list-group-item" v-for="step in inProcess">
                @{{ step.name }}
                <i class="fa fa-check pull-right" @click="toggleCompletion(step)"></i>
            </li>
        </ul>

        <form @submit.prevent="addStep" class="form-inline">
            <input type="text" v-model="newStep" class="form-control">
            <button type="submit" class="btn btn-primary">添加步骤</button>
        </form>

        <h1>已完成的步骤</h1>
        <ul class="list-group">
            <li class="list-group-item" v-for="step in processed">
                @{{ step.name }}
                <i class="fa fa-check pull-right" @click="toggleCompletion(step)"></i>
            </li>
        </ul>

        {{--vue2中全局变量$data本身即是json格式，vue1的写法为 @{{ $data | json }}--}}
        @{{ $data }}

    </div>
@endsection

@section('customJS')
    <script src="{{ asset('js/vue.js') }}"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                steps:[
                    { name:'fix bugs', completed:false },
                    { name:'meeting', completed:false },
                ],
                newStep:''
            },
            methods:{
                addStep:function () {
                    this.steps.push({ name:this.newStep, completed:false });
                    this.newStep = '';
                },
                toggleCompletion:function (step) {
                    step.completed = ! step.completed;
                }
            },
            computed:{
                inProcess:function () {
                    return this.steps.filter(function (step) {
                      return ! step.completed;
                    });
                },
                processed:function () {
                    return this.steps.filter(function (step) {
                        return step.completed;
                    });
                },
            }
        });
    </script>

@endsection