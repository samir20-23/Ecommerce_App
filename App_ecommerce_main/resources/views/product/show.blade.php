<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $product->title }} - Product Details</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .product-image-container {
            overflow: hidden; /* Ensures the zoomed image doesn't overflow */
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 5px;
            max-width: 90%;
            height: auto;
        }
        .product-image {
            transition: transform 0.3s ease; /* Smooth transition for zoom effect */
            width: 100%;
            height: auto;
        }
        .product-image-container:hover .product-image {
            transform: scale(1.1); /* Zoom in by 10% */
        }
        .product-details {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .product-title {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
        }
        .product-price {
            font-size: 1.5rem;
            color: #28a745;
            font-weight: bold;
        }
        .product-stock {
            font-size: 1.2rem;
            color: #dc3545;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">E-Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Products</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Product Detail Page -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <!-- Product Image Container -->
                <div class="product-image-container">
                    <img src="{{ asset($product->img_path) }}" class="img-fluid product-image" alt="Product Image"/>
                </div>
            </div>
            <div class="col-md-6 product-details">
                <h2 class="product-title">{{ $product->title }}</h2>
                <p><strong>Description:</strong> {{ $product->description }}</p>
                <p class="product-price">${{ number_format($product->price, 2) }}</p>
                <p class="product-stock"><strong>Stock:</strong> {{ $product->stock }}</p>

                <!-- Add to Cart Button -->
                <button class="btn btn-custom">Add to Cart</button>

                <!-- Back to Products list Button -->
                <a href="{{ route('product.index') }}" class="btn btn-secondary mt-3">Back to Products</a>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>