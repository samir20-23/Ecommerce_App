@extends('layouts.app')

@section('title', 'View Product')

@section('content')
    <div class="container">
        <h1>Product Details</h1>
        <p><strong>Title:</strong> {{ $product->title }}</p>
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Price:</strong> ${{ $product->price }}</p>
        <p><strong>Stock:</strong> {{ $product->stock }}</p>
    </div>
@endsection
