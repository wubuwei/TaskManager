import Vue from "vue";
import VueResource from "vue-resource";
import Search from './components/search.vue';

Vue.use(VueResource);

new Vue({
    el:'#app-navbar-collapse',
    components:{Search}
})