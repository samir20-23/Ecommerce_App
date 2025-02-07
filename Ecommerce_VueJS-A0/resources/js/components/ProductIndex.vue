<template>
    <div>
      <h1>Product Management</h1>
      <button @click="createProduct">Create Product</button>
  
      <table v-if="products.length">
        <thead>
          <tr>
            <th>Title</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.id">
            <td>{{ product.title }}</td>
            <td>{{ product.price }}</td>
            <td>{{ product.stock }}</td>
            <td>
              <button @click="editProduct(product.id)">Edit</button>
              <button @click="deleteProduct(product.id)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
  
      <div v-if="pagination.total > 0">
        <button @click="changePage(pagination.current_page - 1)" :disabled="pagination.current_page === 1">Previous</button>
        <button @click="changePage(pagination.current_page + 1)" :disabled="pagination.current_page === pagination.last_page">Next</button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        products: [],
        pagination: {}
      };
    },
    created() {
      this.fetchProducts(1);  // Fetch products on component creation
    },
    methods: {
      fetchProducts(page) {
        this.$axios.get(`/api/products?page=${page}`)
          .then(response => {
            this.products = response.data.data;
            this.pagination = response.data;
          })
          .catch(error => {
            console.error("Error fetching products", error);
          });
      },
      changePage(page) {
        if (page >= 1 && page <= this.pagination.last_page) {
          this.fetchProducts(page);
        }
      },
      createProduct() {
        this.$router.push('/create-product');  // Navigate to the product creation page
      },
      editProduct(id) {
        this.$router.push(`/edit-product/${id}`);  // Navigate to the product edit page
      },
      deleteProduct(id) {
        this.$axios.delete(`/api/products/${id}`)
          .then(() => {
            this.fetchProducts(this.pagination.current_page);  // Refresh the product list
          })
          .catch(error => {
            console.error("Error deleting product", error);
          });
      }
    }
  };
  </script>
  
 
<style scoped>
/* Basic modal styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
}

.modal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    padding: 20px;
    border-radius: 8px;
    width: 300px;
}
</style>
  


