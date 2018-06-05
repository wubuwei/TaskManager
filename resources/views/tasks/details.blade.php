@extends('layouts.app')

@section('content')
    <div id="app" class="container">
        <ul class="list-group">
            <li class="list-group-item" v-for="step in steps">
                @{{ step.name }}
                <i class="fa fa-check pull-right" @click="complete(step)"></i>
            </li>
        </ul>

        <form @submit.prevent="addStep" class="form-inline">
            <input type="text" v-model="newStep" class="form-control">
            <button type="submit" class="btn btn-primary">添加步骤</button>
        </form>

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
                complete:function (step) {
                    step.completed = true;
                }
            }
        });
    </script>

@endsection