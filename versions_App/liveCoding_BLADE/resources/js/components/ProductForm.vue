<template>
  <div>
    <button @click="showForm = !showForm" class="btn btn-success">Add Product</button>

    <div v-if="showForm" class="card mt-3 p-3">
      <input type="text" v-model="product.title" placeholder="Title" class="form-control mb-2">
      <input type="file" @change="handleFileUpload" class="form-control mb-2">
      <textarea v-model="product.description" placeholder="Description" class="form-control mb-2"></textarea>
      <input type="number" v-model="product.price" placeholder="Price" class="form-control mb-2">
      <input type="number" v-model="product.stock" placeholder="Stock" class="form-control mb-2">
      <button @click="saveProduct" class="btn btn-primary">Save</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      showForm: false,
      product: { title: '', description: '', price: '', stock: '', image: null },
    };
  },
  methods: {
    handleFileUpload(event) {
      this.product.image = event.target.files[0];
    },
    async saveProduct() {
      let formData = new FormData();
      formData.append('title', this.product.title);
      formData.append('description', this.product.description);
      formData.append('price', this.product.price);
      formData.append('stock', this.product.stock);
      if (this.product.image) formData.append('image', this.product.image);

      try {
        let response = await axios.post('/api/products', formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        });
        alert('Product added successfully!');
        this.$emit('product-added', response.data);
        this.showForm = false; 
      } catch (error) {
        console.error(error);
      }
    }
  }
};
</script>
