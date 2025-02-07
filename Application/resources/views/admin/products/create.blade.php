<form id="createProductForm" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="3" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" name="price" id="price" step="0.01" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="stock">Stock</label>
        <input type="number" name="stock" id="stock" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="img_path">Image</label>
        <input type="file" name="img_path" id="img_path" class="form-control-file" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
