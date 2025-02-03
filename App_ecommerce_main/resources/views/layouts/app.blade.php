<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Ecommerce App')</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    /* Custom styles can go here */
    .product-image {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        object-fit: cover;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ url('/') }}">Ecommerce App</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('products.index') }}">Products</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container mt-4">
    @yield('content')
  </div>

  <!-- JavaScript assets -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
  @yield('scripts')
</body>
</html>
