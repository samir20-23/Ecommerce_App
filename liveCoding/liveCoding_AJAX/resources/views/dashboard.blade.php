@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <h1 class="mb-4">Product Dashboard</h1>

        <!-- Dashboard Cards -->
        <div class="row">
            <!-- Products Card -->
            <div class="col-lg-4 col-md-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalProducts }}</h3>
                        <p>Total Products</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <a href="{{ route('admin.products.index') }}" class="small-box-footer">
                        Show More <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Users Card -->
            <div class="col-lg-4 col-md-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalUsers }}</h3>
                        <p>Total Users</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                        Show More <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
