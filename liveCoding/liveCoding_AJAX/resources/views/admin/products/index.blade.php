@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container">
    <h1 class="mb-4">Product List</h1>

    <!-- Button to load the Create form -->
    <a href="javascript:void(0)" id="createProductBtn" class="btn btn-primary mb-3">Add New Product</a>

    <!-- Products Table -->
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
                    @if ($product->img_path)
                        <img src="{{ asset($product->img_path) }}" style="width:50px; height:50px; border-radius:8px;" alt="Product Image">
                   
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
                        <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $product->id }}">Delete</button>
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
      <!-- Pagination -->
      <div class="d-flex justify-content-center mt-4">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productModalTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="productModalBody">
        <!-- Content loaded dynamically will appear here -->
      </div>
    </div>
  </div>
</div>

<!-- Include jQuery and Bootstrap JS if not already included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    
    // Helper function to load content into the modal and show it
    function showModal(title, htmlContent) {
        $('#productModalTitle').text(title);
        $('#productModalBody').html(htmlContent);
        $('#productModal').modal('show');
    }

    // 1. Load the Create Product form into the modal when "Add New Product" is clicked
    $('#createProductBtn').on('click', function(){
       $.ajax({
          url: "{{ route('admin.products.create') }}",
          method: 'GET',
          success: function(html){
             showModal('Add New Product', html);
          },
          error: function(){
             alert('Error loading create form.');
          }
       });
    });

    // 2. Handle Create Product form submission via AJAX
    $(document).on('submit', '#createProductForm', function(e){
         e.preventDefault();
         var formData = new FormData(this);
         $.ajax({
             url: "{{ route('admin.products.store') }}",
             method: 'POST',
             data: formData,
             processData: false,
             contentType: false,
             success: function(response){
                 alert(response.message);
                 var product = response.product;
                 var imageHtml = product.img_path 
                     ? '<img src="/' + product.img_path + '" style="width:50px; height:50px; border-radius:8px;" alt="Product Image">' 
                     : '<span class="text-muted">No Image</span>';
                     
                 var newRow = '<tr id="product-' + product.id + '">' +
                     '<td>' + product.id + '</td>' +
                     '<td>' + product.title + '</td>' +
                     '<td>' + product.description + '</td>' +
                     '<td>$' + parseFloat(product.price).toFixed(2) + '</td>' +
                     '<td>' + product.stock + '</td>' +
                     '<td>' + imageHtml + '</td>' +
                     '<td>' +
                        '<a href="javascript:void(0)" class="btn btn-info btn-sm showProductBtn" data-id="' + product.id + '">View</a> ' +
                        '<a href="javascript:void(0)" class="btn btn-warning btn-sm editProductBtn" data-id="' + product.id + '">Edit</a> ' +
                        '<form action="/admin/products/' + product.id + '" method="POST" class="d-inline" id="deleteForm-' + product.id + '">' +
                            '@csrf' +
                            '@method("DELETE")' +
                            '<button class="btn btn-danger btn-sm delete-btn" data-id="' + product.id + '">Delete</button>' +
                        '</form>' +
                     '</td>' +
                 '</tr>';
                 
                 $('#productTable tbody').append(newRow);
                 $('#productModal').modal('hide');
             },
             error: function(){
                 alert('Error saving product.');
             }
         });
    });

    // 3. Load the Edit Product form into the modal when "Edit" is clicked
    $(document).on('click', '.editProductBtn', function(){
       var productId = $(this).data('id');
       $.ajax({
          url: "/admin/products/" + productId + "/edit",
          method: "GET",
          success: function(html){
              showModal('Edit Product', html);
          },
          error: function(){
              alert('Error loading edit form.');
          }
       });
    });

    // 4. Handle Edit Product form submission via AJAX
    $(document).on('submit', '#editProductForm', function(e){
       e.preventDefault();
       var productId = $(this).find('input[name="id"]').val();
       var formData = new FormData(this);
       if (!formData.has('_method')) {
           formData.append('_method', 'PUT');
       }
       $.ajax({
          url: "/admin/products/" + productId,
          method: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function(response){
              alert(response.message);
              var product = response.product;
              var imageHtml = product.img_path 
                  ? '<img src="/' + product.img_path + '" style="width:50px; height:50px; border-radius:8px;" alt="Product Image">' 
                  : '<span class="text-muted">No Image</span>';
              
              var updatedRow = '<td>' + product.id + '</td>' +
                     '<td>' + product.title + '</td>' +
                     '<td>' + product.description + '</td>' +
                     '<td>$' + parseFloat(product.price).toFixed(2) + '</td>' +
                     '<td>' + product.stock + '</td>' +
                     '<td>' + imageHtml + '</td>' +
                     '<td>' +
                        '<a href="javascript:void(0)" class="btn btn-info btn-sm showProductBtn" data-id="' + product.id + '">View</a> ' +
                        '<a href="javascript:void(0)" class="btn btn-warning btn-sm editProductBtn" data-id="' + product.id + '">Edit</a> ' +
                        '<form action="/admin/products/' + product.id + '" method="POST" class="d-inline" id="deleteForm-' + product.id + '">' +
                            '@csrf' +
                            '@method("DELETE")' +
                            '<button class="btn btn-danger btn-sm delete-btn" data-id="' + product.id + '">Delete</button>' +
                        '</form>' +
                     '</td>';
                     
              $('#product-' + product.id).html(updatedRow);
              $('#productModal').modal('hide');
          },
          error: function(){
              alert('Error updating product.');
          }
       });
    });

    // 5. Handle Delete Product action via AJAX
    $(document).on('click', '.delete-btn', function(e){
       e.preventDefault();
       var productId = $(this).data('id');
       var form = $('#deleteForm-' + productId);
       if (confirm("Are you sure you want to delete this product?")) {
           $.ajax({
               url: form.attr('action'),
               method: 'POST',
               data: new FormData(form[0]),
               processData: false,
               contentType: false,
               success: function(response){
                   alert(response.message);
                   $('#product-' + productId).remove();
               },
               error: function(){
                   alert('Error deleting product.');
               }
           });
       }
    });

    // 6. Load the Show Product details into the modal when "View" is clicked
    $(document).on('click', '.showProductBtn', function(){
       var productId = $(this).data('id');
       $.ajax({
           url: "/admin/products/" + productId,
           method: "GET",
           success: function(html){
               showModal('Product Details', html);
           },
           error: function(){
               alert('Error loading product details.');
           }
       });
    });

});
</script>
@endsection
