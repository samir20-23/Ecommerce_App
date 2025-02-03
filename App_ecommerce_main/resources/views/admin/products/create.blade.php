<form id="createProductForm" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Product Title</label>
        <input type="text" name="title" id="title" class="form-control" placeholder="Enter title" required>
    </div>
    <div class="form-group">
        <label for="description">Product Description</label>
        <textarea name="description" id="description" rows="3" class="form-control" placeholder="Enter description"></textarea>
    </div>
    <div class="form-group">
        <label for="price">Price ($)</label>
        <input type="number" name="price" id="price" step="0.01" class="form-control" placeholder="0.00" required>
    </div>
    <div class="form-group">
        <label for="stock">Stock Quantity</label>
        <input type="number" name="stock" id="stock" class="form-control" placeholder="Enter stock" required>
    </div>
    <div class="form-group">
        <label for="img_path">Product Image</label>
        <input type="file" name="img_path" id="img_path" class="form-control-file" accept="image/*">
    </div>
    <button type="submit" class="btn btn-success">Create Product</button>
</form>
