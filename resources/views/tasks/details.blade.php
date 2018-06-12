@extends('layouts.app')

@section('customHeader')
    <meta name="token" id="token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div id="app" class="container">
        <h1 class="text-muted">{{ $task->title }}</h1>

        <h2 v-if="remaings.length">
            待完成的步骤(@{{ remaings.length }})
            <span class="btn btn-sm btn-info" @click="completeAll">完成所有</span>
        </h2>
        <ul class="list-group">
            <li class="list-group-item" v-for="(step,index) in inProcess">
                <span @dblclick="editStep(step)">@{{ step.name }}</span>
                <span class="pull-right">
                    <i class="fa fa-check" @click="toggleCompletion(step)"></i>
                    <i class="fa fa-close" @click="removeStep(step)"></i>
                </span>
            </li>
        </ul>

        <form @submit.prevent="addStep" class="form-inline,form-horizontal">
            <div class="form-group col-md-8">
                <label v-if="! newStep">完成该任务(Task)需要哪些步骤(Step)呢?</label>
                <input type="text" v-model="newStep" ref="newStep" class="form-control" placeholder="I need to ...">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" v-if="newStep">添加步骤</button>
            </div>
        </form>
        <div class="clearfix"></div>

        <h2 v-show="completions.length">
            已完成的步骤(@{{ completions.length }})
            <span class="btn btn-sm btn-danger" @click="clearCompleted">清除所有已完成</span>
        </h2>
        <ul class="list-group">
            <li class="list-group-item" v-for="(step,index) in processed">
                @{{ step.name }}
                <span class="pull-right">
                    <i class="fa fa-check" @click="toggleCompletion(step)"></i>
                    <i class="fa fa-close" @click="removeStep(step)"></i>
                </span>
            </li>
        </ul>

        {{--vue2中全局变量$data本身即是json格式，vue1的写法为 @{{ $data | json }}--}}
       {{--<pre>@{{ $data }}</pre>--}}@{{ $data }}

    </div>
@endsection

@section('customJS')
    <script src="{{ asset('js/vue.js') }}"></script>
    <script src="{{ asset('js/vue-resource.js') }}"></script>
    <script>
        Vue.http.headers.common['X-CSRF-TOKEN'] = $('#token').attr('content');
        var resource = Vue.resource('/tasks/{{ $task->id }}/steps{/id}');

        new Vue({
            el: '#app',
            data: {
                steps:[
                    { name:'', completed:false },
                ],
                newStep:'',
                baseURL:'/tasks/{{ $task->id }}/steps'
            },
            mounted:function(){
              this.fetchSteps();
            },
            methods:{
                fetchSteps:function(){
                    //改用resource后，query()等同于get()
                    resource.query().then((response)=>{
                        //success
                        this.steps  = response.body;
                    },(response)=>{
                        //error
                        response.status;
                    });
                },
                addStep:function () {
                    resource.save('', { name:this.newStep}).then((response)=>{
                        //success
                        this.newStep = '';
                        this.fetchSteps();
                    },(response)=>{
                        //error
                        response.status;
                    });
                },
                removeStep:function(index){
                    resource.delete({id:index.id}).then((response)=>{
                        //success
                        this.fetchSteps();
                    },(response)=>{
                        //error
                        response.status;
                    });
                },
                editStep:function(step){
                    //移除当前step
                    this.removeStep(step);
                    //将当前step加载到input输入框
                    this.newStep = step.name;
                    //focus输入框
                    this.$refs.newStep.focus();
                },
                toggleCompletion:function (step) {
                    resource.update({id:step.id}, {opposite: ! step.completed}).then((response)=>{
                        //success
                        this.fetchSteps();
                    },(response)=>{
                        //error
                        response.status;
                    });
                },
                completeAll:function () {
                    this.$http.post(this.baseURL+'/complete').then((response)=>{
                        //success
                        this.fetchSteps();
                    },(response)=>{
                        //error
                        response.status;
                    });
                },
                clearCompleted:function () {
                    this.$http.delete(this.baseURL+'/clear').then((response)=>{
                        //success
                        this.fetchSteps();
                    },(response)=>{
                        //error
                        response.status;
                    });
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
                completions:function () {
                    return this.steps.filter(function (step) {
                       return step.completed;
                    });
                },
                remaings:function () {
                    return this.steps.filter(function (step) {
                        return ! step.completed;
                    });
                },
            }
        });
    </script>

@endsection