@extends('layouts.app')

@section('content')
    <div id="app" class="container">
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
       <pre>@{{ $data }}</pre>

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
                removeStep:function(index){
                    this.steps.splice(index,1);
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
                    step.completed = ! step.completed;
                },
                completeAll:function () {
                  this.steps.forEach(function (step) {
                      step.completed = true;
                  })
                },
                clearCompleted:function () {
                    this.steps = this.steps.filter(function (step) {
                        return !step.completed;
                    })
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