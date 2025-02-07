@extends('adminlte::page')

@section('title', 'Ecommerce App')

@section('content_header')
    @yield('header')
@endsection

@section('content')
    @yield('content')
@endsection

@section('footer')
    @include('layouts.partials.footer')
@endsection
