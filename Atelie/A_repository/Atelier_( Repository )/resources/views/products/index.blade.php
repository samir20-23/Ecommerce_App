@foreach($products as $product)
    <div>
        <h3>{{ $product->name }}</h3>
        <p>{{ $product->description }}</p>
        <p>${{ $product->price }}</p>
    </div>
@endforeach
