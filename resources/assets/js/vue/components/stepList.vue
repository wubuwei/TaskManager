

<template>
    <li class="list-group-item">
        <span @dblclick="editStep(step)">{{ step.name }}</span>
        <span class="pull-right">
            <i class="fa fa-check" @click="toggleCompletion(step)"></i>
            <i class="fa fa-close" @click="removeStep(step)"></i>
        </span>
    </li>
</template>

<script>
    export default {
        props:['step'],
        methods:{
            editStep:function (step) {
                this.$emit('edit', this.step)
            },
            toggleCompletion:function (step) {
                this.$emit('toggle', step);
            },
            removeStep:function (step) {
                this.$emit('remove', step);
            }
        }
    }
</script>

<style>

</style>