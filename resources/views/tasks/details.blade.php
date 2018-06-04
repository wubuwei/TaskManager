@extends('layouts.app')

@section('content')
    <div id="app" class="container">
        <ul class="list-group">
            <li class="list-group-item" v-for="step in steps">@{{ step.name }}</li>
            <input type="text" v-model="newStep" @keyup.enter="addStep" class="form-control">
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
                }
            }
        });
    </script>

@endsection