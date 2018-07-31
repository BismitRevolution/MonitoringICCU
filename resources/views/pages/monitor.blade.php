@extends('main')

@section('title', config('app.name'))

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/pages/monitor.css') }}">
@endsection

@section('content')
<div class="">
    
</div>
@endsection

@section('extra-js')
<script type="application/javascript" src="{{ asset('js/pages/monitor.js') }}"></script>
@endsection
