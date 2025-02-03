$(document).ready(function () {

    function loadProducts() {
        $.ajax({
            url: "/admin/products/fetch",
            method: "GET",
            success: function (response) {
                let products = response.products.data;
                let html = "";
                products.forEach(product => {
                    html += `
                        <tr>
                            <td>${product.id}</td>
                            <td>${product.title}</td>
                            <td>${product.description}</td>
                            <td>${product.price}</td>
                            <td>${product.stock}</td>
                            <td><img src="/storage/${product.img_path}" width="50"></td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-product" data-id="${product.id}">Edit</button>
                                <button class="btn btn-sm btn-danger delete-product" data-id="${product.id}">Delete</button>
                            </td>
                        </tr>
                    `;
                });
                $("#productTable tbody").html(html);
            }
        });
    }

    loadProducts();

    $("#addProductForm").submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: "/admin/products",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                alert(response.message);
                loadProducts();
                $("#addProductForm")[0].reset();
            },
            error: function (response) {
                alert("Error creating product.");
            }
        });
    });

    $(document).on("click", ".edit-product", function () {
        let id = $(this).data("id");
        $.ajax({
            url: `/admin/products/${id}/edit`,
            method: "GET",
            success: function (response) {
                $("#editTitle").val(response.product.title);
                $("#editDescription").val(response.product.description);
                $("#editPrice").val(response.product.price);
                $("#editStock").val(response.product.stock);
                $("#editProductId").val(response.product.id);
                $("#editModal").modal("show");
            }
        });
    });

    $("#editProductForm").submit(function (e) {
        e.preventDefault();
        let id = $("#editProductId").val();
        let formData = new FormData(this);

        $.ajax({
            url: `/admin/products/${id}`,
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                alert(response.message);
                loadProducts();
                $("#editModal").modal("hide");
            }
        });
    });

    $(document).on("click", ".delete-product", function () {
        let id = $(this).data("id");
        if (confirm("Are you sure?")) {
            $.ajax({
                url: `/admin/products/${id}`,
                method: "DELETE",
                success: function (response) {
                    alert(response.message);
                    loadProducts();
                }
            });
        }
    });
});
