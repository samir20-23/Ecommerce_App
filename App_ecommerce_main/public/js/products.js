$(document).ready(function() {
    // Set up CSRF token for AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Helper: Show modal with dynamic content
    function showModal(title, content) {
        $('#productModalTitle').text(title);
        $('#productModalBody').html(content);
        $('#productModal').modal('show');
    }

    // 1. Load Create Form via AJAX when "Add New Product" is clicked
    $('#createProductBtn').on('click', function() {
        $.get('/admin/products/create', function(response) {
            showModal('Create New Product', response);
        }).fail(function() {
            alert('Error loading create form.');
        });
    });

    // 2. Handle Create Form Submission via AJAX
    $(document).on('submit', '#createProductForm', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: '/admin/products',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response.message);
                // Append new row to table (build row HTML)
                var p = response.product;
                var img = p.img_path ? '<img src="/' + p.img_path + '" class="product-image" alt="Product Image">' : '<span class="text-muted">No Image</span>';
                var row = '<tr id="product-' + p.id + '">'+
                    '<td>' + p.id + '</td>'+
                    '<td>' + p.title + '</td>'+
                    '<td>' + p.description + '</td>'+
                    '<td>$' + parseFloat(p.price).toFixed(2) + '</td>'+
                    '<td>' + p.stock + '</td>'+
                    '<td>' + img + '</td>'+
                    '<td>'+
                        '<button class="btn btn-info btn-sm showProductBtn" data-id="' + p.id + '">View</button> '+
                        '<button class="btn btn-warning btn-sm editProductBtn" data-id="' + p.id + '">Edit</button> '+
                        '<form action="/admin/products/' + p.id + '" method="POST" class="d-inline deleteForm" id="deleteForm-' + p.id + '">'+
                            '<input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '">'+
                            '<input type="hidden" name="_method" value="DELETE">'+
                            '<button class="btn btn-danger btn-sm deleteProductBtn" data-id="' + p.id + '">Delete</button>'+
                        '</form>'+
                    '</td>'+
                '</tr>';
                $('#productTable tbody').append(row);
                $('#productModal').modal('hide');
            },
            error: function() {
                alert('Error creating product.');
            }
        });
    });

    // 3. Load Edit Form via AJAX
    $(document).on('click', '.editProductBtn', function() {
        var id = $(this).data('id');
        $.get('/admin/products/' + id + '/edit', function(response) {
            showModal('Edit Product', response);
        }).fail(function() {
            alert('Error loading edit form.');
        });
    });

    // 4. Handle Edit Form Submission via AJAX
    $(document).on('submit', '#editProductForm', function(e) {
        e.preventDefault();
        var id = $(this).find('input[name="id"]').val();
        var formData = new FormData(this);
        $.ajax({
            url: '/admin/products/' + id,
            type: 'POST', // using POST with _method=PUT
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response.message);
                var p = response.product;
                var img = p.img_path ? '<img src="/' + p.img_path + '" class="product-image" alt="Product Image">' : '<span class="text-muted">No Image</span>';
                var row = '<td>' + p.id + '</td>'+
                    '<td>' + p.title + '</td>'+
                    '<td>' + p.description + '</td>'+
                    '<td>$' + parseFloat(p.price).toFixed(2) + '</td>'+
                    '<td>' + p.stock + '</td>'+
                    '<td>' + img + '</td>'+
                    '<td>'+
                        '<button class="btn btn-info btn-sm showProductBtn" data-id="' + p.id + '">View</button> '+
                        '<button class="btn btn-warning btn-sm editProductBtn" data-id="' + p.id + '">Edit</button> '+
                        '<form action="/admin/products/' + p.id + '" method="POST" class="d-inline deleteForm" id="deleteForm-' + p.id + '">'+
                            '<input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '">'+
                            '<input type="hidden" name="_method" value="DELETE">'+
                            '<button class="btn btn-danger btn-sm deleteProductBtn" data-id="' + p.id + '">Delete</button>'+
                        '</form>'+
                    '</td>';
                $('#product-' + p.id).html(row);
                $('#productModal').modal('hide');
            },
            error: function() {
                alert('Error updating product.');
            }
        });
    });

    // 5. Handle Delete Product via AJAX
    $(document).on('click', '.deleteProductBtn', function(e) {
        e.preventDefault();
        if (!confirm("Are you sure you want to delete this product?")) {
            return;
        }
        var id = $(this).data('id');
        var form = $('#deleteForm-' + id);
        var formData = new FormData(form[0]);
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response.message);
                $('#product-' + id).remove();
            },
            error: function() {
                alert('Error deleting product.');
            }
        });
    });

    // 6. Load Product Details via AJAX
    $(document).on('click', '.showProductBtn', function() {
        var id = $(this).data('id');
        $.get('/admin/products/' + id, function(response) {
            showModal('Product Details', response);
        }).fail(function() {
            alert('Error loading product details.');
        });
    });

    // 7. Optional: Filter Form (redirect on submit)
    $('#filterForm').on('submit', function(e) {
        // Let the form submit normally to display paginated results.
    });
});
