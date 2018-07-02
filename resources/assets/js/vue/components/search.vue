<template>
    <form class="navbar-form navbar-left">
        <div class="form-group">
            <div class="input-group">
                <input type="text" class="form-control" @focus="fetchTasks" @blur="leave" placeholder="Search">
                <div class="input-group-addon"><i class="fa fa-search"></i></div>
            </div>
        </div>

        <ul class="list-group search-list" v-if="show">
            <li class="list-group-item" v-for="task in tasks">
                <a :href="link(task)">{{task.title}}</a>
            </li>
        </ul>
    </form>
</template>

<script>
    export default {
        data:function(){
            return {
                tasks:[],
                show:false
            }
        },
        methods:{
            fetchTasks:function () {
                this.$http.get('/tasks/searchApi').then((response)=>{
                    this.show = true;
                    this.tasks = response.body;
                },(response)=>{

                });
            },
            link:function (task) {
                return '/tasks/' + task.id;
            },
            leave:function () {
                var vm = this;
                setTimeout(function () {
                    vm.show = false;
                },3000);
            }
        }
    }
</script>

<style>
    .navbar-default .navbar-collapse, .navbar-default .navbar-form {
        height: 3em;
    }

    .navbar-form .search-list {
        height: 30em;
        overflow: auto;
    }
</style>