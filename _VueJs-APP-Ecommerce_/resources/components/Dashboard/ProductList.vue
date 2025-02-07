<template>
    <div class="product-list">
      <h1>Products</h1>
      <!-- List of products -->
      <ul v-if="products.length">
        <li v-for="product in products" :key="product.id" class="product-item">
          <h2>{{ product.title }}</h2>
          <p>{{ product.content }}</p>
          <p><strong>Price:</strong> {{ product.price }}</p>
          <p><strong>Stock:</strong> {{ product.stock }}</p>
          <!-- Buttons for future editing/deleting -->
          <button @click="editProduct(product)">Edit</button>
          <button @click="deleteProduct(product.id)">Delete</button>
        </li>
      </ul>
      <p v-else>No products found.</p>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: "ProductList",
    data() {
      return {
        products: [],
      };
    },
    created() {
      this.fetchProducts();
    },
    methods: {
      // Fetch all products from the Laravel API
      fetchProducts() {
        axios
          .get('http://localhost:8000/api/products')
          .then(response => {
            this.products = response.data;
          })
          .catch(error => {
            console.error("Error fetching products:", error);
          });
      },
  
      // Stub method for editing a product (to be implemented)
      editProduct(product) {
        console.log("Edit product:", product);
        // For example, navigate to an edit form or open a modal here
      },
  
      // Delete a product by its ID and refresh the list
      deleteProduct(productId) {
        if (confirm("Are you sure you want to delete this product?")) {
          axios
            .delete(`http://localhost:8000/api/products/${productId}`)
            .then(response => {
              console.log(response.data.message);
              // Refresh the list of products
              this.fetchProducts();
            })
            .catch(error => {
              console.error("Error deleting product:", error);
            });
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .product-list {
    max-width: 800px;
    margin: 0 auto;
    padding: 1rem;
  }
  .product-item {
    border: 1px solid #ccc;
    padding: 1rem;
    margin-bottom: 1rem;
  }
  button {
    margin-right: 0.5rem;
  }
  </style>
  