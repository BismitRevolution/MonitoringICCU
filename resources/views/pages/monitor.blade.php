@extends('main')

@section('title', config('app.name'))

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/pages/monitor.css') }}">
@endsection

@section('content')
<div class="container" style="margin-top: 35px;">
    <h3 id="temperature-title">Temperature</h3>
    <div class="grid-x">
        <div class="cell small-10">
            <div id="temperature" class="ct-chart"></div>
        </div>
        <div class="cell small-2">
            <h1 id="temperature-current">0</h1>
        </div>
    </div>
    <h3 id="heartbeat-title">Heartbeat</h3>
    <div class="grid-x">
        <div class="cell small-10">
            <div id="heartbeat" class="ct-chart"></div>
        </div>
        <div class="cell small-2">
            <h1 id="heartbeat-current">0</h1>
        </div>
    </div>
    </div>
@endsection

@section('extra-js')
<script type="application/javascript" src="{{ asset('js/data.js') }}"></script>
<script type="application/javascript" src="{{ asset('js/pages/monitor.js') }}"></script>
@endsection
