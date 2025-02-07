@extends('adminlte::page')

@section('title', 'Ecommerce App')

@section('content_header')
    @yield('header')
    @vite(['resources/js/app.js'])
@endsection

@section('content')
    @yield('content')
@endsection

@section('footer')
    @include('layouts.partials.footer')
@endsection
