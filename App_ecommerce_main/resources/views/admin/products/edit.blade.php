<form id="editProductForm" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ $product->id }}">
    <div class="form-group">
        <label for="title">Product Title</label>
        <input type="text" name="title" id="title" value="{{ $product->title }}" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Product Description</label>
        <textarea name="description" id="description" rows="3" class="form-control">{{ $product->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="price">Price ($)</label>
        <input type="number" name="price" id="price" step="0.01" value="{{ $product->price }}" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="stock">Stock Quantity</label>
        <input type="number" name="stock" id="stock" value="{{ $product->stock }}" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="img_path">Product Image (leave blank to keep current)</label>
        <input type="file" name="img_path" id="img_path" class="form-control-file" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary">Update Product</button>
</form>
