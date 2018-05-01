@extends('layouts.app')

@section('content')
    <div id="app" class="container">
        <h1>@{{ message }}</h1>
        <input type="text" v-model="message">
    </div>
@endsection

@section('customJS')
    <script src="{{ asset('js/vue.js') }}"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                message: 'helloworld',
            }
        });
    </script>

@endsection