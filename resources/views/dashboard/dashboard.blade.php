@extends('layouts.default')

@vite('resources/css/dashboard/dashboard.css')

@section('aside')
    @include('layouts.sidebar')
@endsection

@section('main')

    <h1>Dashboard</h1>



    @vite('resources/js/dashboard/dashboard.js')

@endsection

@section('footer')

@endsection