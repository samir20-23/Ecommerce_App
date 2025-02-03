<div class="container">
    <h4>{{ $product->title }}</h4>
    <p>{{ $product->description }}</p>
    <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
    <p><strong>Stock:</strong> {{ $product->stock }}</p>
    @if ($product->img_path && file_exists(public_path($product->img_path)))
        <img src="{{ asset($product->img_path) }}" class="img-fluid mt-3" alt="Product Image">
    @else
        <p class="text-muted">No image available.</p>
    @endif
</div>
