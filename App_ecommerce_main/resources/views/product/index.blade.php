<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
                @foreach ($products as $key)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset($key->img_path) }}" class="card-img-top" alt="Product Image"/>   <div class="card-body">
                            <h5 class="card-title">{{ $key->title }}</h5>   
                            <p class="card-text">{{ $key->description }}</p>
                            <p class="card-text"><strong>Price:</strong>{{ $key->price }}</p>
                            <p class="card-text"><strong>Stock:</strong> {{ $key->stock}}</p>
                            <a href="#" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Include Bootstrap JS (optional, only if you need Bootstrap's JS features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>