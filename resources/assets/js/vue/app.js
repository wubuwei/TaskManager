import Vue from 'vue';
import VueResource from 'vue-resource';
var StepList = require('./components/stepList.vue');

Vue.use(VueResource);

Vue.http.headers.common['X-CSRF-TOKEN'] = $('#token').attr('content');
var resource = Vue.resource(top.location+'/steps{/id}');

new Vue({
    el: '#app',
    data: {
        steps:[
            { name:'', completed:false },
        ],
        newStep:'',
        baseURL:self.location+'/steps'
    },
    mounted:function(){
        this.fetchSteps();
    },
    components:{ StepList },
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
    },
});