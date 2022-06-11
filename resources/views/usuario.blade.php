@extends('layouts.app')
@section('content')
<div id="app">
    <div id="main" data-app class="main">
        <usuario-component />
    </div>
</div>
<script type="{{ asset('../../js/app.js') }} "></script>
<script type="{{ asset('../../js/bootstrap.js') }} "></script>
@endsection