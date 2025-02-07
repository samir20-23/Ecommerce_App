<div class="container">
    <h4>{{ $product->title }}</h4>
    <p>{{ $product->description }}</p>
    <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
    <p><strong>Stock:</strong> {{ $product->stock }}</p>
    @if ($product->img_path)
        <img src="{{ asset($product->img_path) }}" class="img-fluid" alt="Product Image">
        
    @else
        <p>No Image Available</p>
    @endif
</div>
