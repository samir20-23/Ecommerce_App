@extends('adminlte::page') <!-- Assuming you're using the AdminLTE Laravel package -->

@section('title', 'Ecommerce App')

@section('css')
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
@endsection

@section('content_header')
@yield('header')
@endsection

@section('content')
    @yield('content')
@endsection


@section('footer')
    @include('layouts.partials.footer') <!-- Footer -->
@endsection

@section('js')
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Ensure your JS and CSS assets are included -->
@endsection
