

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
        props:['step']
    }
</script>

<style>

</style>