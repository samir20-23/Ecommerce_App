
 @extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container">
    <h1 class="mb-4">Product List</h1>

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Add New Product</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->description }}</td>
                <td>${{ number_format($product->price, 2) }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    @if($product->img_path)
                        <img src="{{ asset($product->img_path) }}" style="width: 50px; height: 50px; border-radius: 8px;" alt="Product Image">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.products.show', $product) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No products available</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 

{{-- @extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container">
    <h1 class="mb-4">Product List</h1>

    <a href="javascript:void(0)" id="createProductBtn" class="btn btn-primary mb-3">Add New Product</a>

    <div id="productFormContainer"></div>

    <table class="table table-bordered table-striped" id="productTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr id="product-{{ $product->id }}">
                <td>{{ $product->id }}</td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->description }}</td>
                <td>${{ number_format($product->price, 2) }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    @if($product->img_path)
                        <img src="{{ asset($product->img_path) }}" style="width: 50px; height: 50px; border-radius: 8px;" alt="Product Image">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>
                <td>
                    <a href="javascript:void(0)" class="btn btn-info btn-sm showProductBtn" data-id="{{ $product->id }}">View</a>
                    <a href="javascript:void(0)" class="btn btn-warning btn-sm editProductBtn" data-id="{{ $product->id }}">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" id="deleteForm-{{ $product->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No products available</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function () {
        // Show the create form
        $('#createProductBtn').click(function () {
            $.get("{{ route('admin.products.create') }}", function (data) {
                $('#productFormContainer').html(data);
            });
        });

        // Show product details
        $('.showProductBtn').click(function () {
            var productId = $(this).data('id');
            $.get("{{ route('admin.products.show', '') }}/" + productId, function (data) {
                $('#productFormContainer').html(data);
            });
        });

        // Edit product
        $('.editProductBtn').click(function () {
            var productId = $(this).data('id');
            $.get("{{ route('admin.products.edit', '') }}/" + productId, function (data) {
                $('#productFormContainer').html(data);
            });
        });

        // Handle product form submission (Create or Edit)
        $(document).on('submit', 'form', function (e) {
            e.preventDefault();
            var form = $(this);
            var actionUrl = form.attr('action');
            var method = form.attr('method');

            $.ajax({
                url: actionUrl,
                method: method,
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (response) {
                    // You can update the table or show a success message here
                    if (response.success) {
                        // Example: Add new row to table or update the existing row
                        if (method == 'POST') {
                            var newProduct = response.product;
                            var row = `<tr id="product-${newProduct.id}">
                                <td>${newProduct.id}</td>
                                <td>${newProduct.title}</td>
                                <td>${newProduct.description}</td>
                                <td>$${newProduct.price}</td>
                                <td>${newProduct.stock}</td>
                                <td><img src="${newProduct.img_path}" style="width: 50px; height: 50px; border-radius: 8px;" alt="Product Image"></td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-info btn-sm showProductBtn" data-id="${newProduct.id}">View</a>
                                    <a href="javascript:void(0)" class="btn btn-warning btn-sm editProductBtn" data-id="${newProduct.id}">Edit</a>
                                    <form action="/admin/products/${newProduct.id}" method="POST" class="d-inline" id="deleteForm-${newProduct.id}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>`;
                            $('#productTable tbody').append(row);
                        } else if (method == 'PUT') {
                            var updatedProduct = response.product;
                            var updatedRow = `
                                <td>${updatedProduct.id}</td>
                                <td>${updatedProduct.title}</td>
                                <td>${updatedProduct.description}</td>
                                <td>$${updatedProduct.price}</td>
                                <td>${updatedProduct.stock}</td>
                                <td><img src="${updatedProduct.img_path}" style="width: 50px; height: 50px; border-radius: 8px;" alt="Product Image"></td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-info btn-sm showProductBtn" data-id="${updatedProduct.id}">View</a>
                                    <a href="javascript:void(0)" class="btn btn-warning btn-sm editProductBtn" data-id="${updatedProduct.id}">Edit</a>
                                    <form action="/admin/products/${updatedProduct.id}" method="POST" class="d-inline" id="deleteForm-${updatedProduct.id}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>`;
                            $(`#product-${updatedProduct.id}`).html(updatedRow);
                        }
                        $('#productFormContainer').html('');
                    }
                }
            });
        });
    });
</script>
@endsection --}}
