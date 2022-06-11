@extends('layouts.app')
@section('content')
<div id="app">
    <div id="main" data-app class="main">
        <empleado />
    </div>
</div>
<script type="{{ asset('../../js/app.js') }} "></script>
<script type="{{ asset('../../js/bootstrap.js') }} "></script>
@endsection
