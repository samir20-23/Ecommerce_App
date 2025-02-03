
<template>
    <div class="container">
        <h1>Product Management</h1>

        <!-- Add New Product Button -->
        <button @click="openCreateModal" class="btn btn-primary mb-3">Add New Product</button>

        <!-- Products Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product, index) in products" :key="product.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ product.title }}</td>
                    <td>{{ product.description }}</td>
                    <td>${{ product.price }}</td>
                    <td>{{ product.stock }}</td>
                    <td>
                        <img v-if="product.img_path" :src="product.img_path" alt="Image" width="50">
                        <span v-else>No Image</span>
                    </td>
                    <td>
                        <button @click="openEditModal(product)" class="btn btn-warning btn-sm">Edit</button>
                        <button @click="deleteProduct(product.id)" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Add/Edit Product Modal -->
        <div class="modal" tabindex="-1" style="display: block;" v-if="showModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ isEdit ? 'Edit Product' : 'Add New Product' }}</h5>
                        <button type="button" class="btn-close" @click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="submitForm">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" v-model="formData.title" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" v-model="formData.description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" v-model="formData.price" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" v-model="formData.stock" required>
                            </div>
                            <div class="mb-3">
                                <label for="img_path" class="form-label">Image</label>
                                <input type="file" class="form-control" @change="onFileChange" accept="image/*">
                            </div>
                            <button type="submit" class="btn btn-primary">{{ isEdit ? 'Update' : 'Create' }} Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            products: [],
            showModal: false,
            isEdit: false,
            formData: {
                title: '',
                description: '',
                price: '',
                stock: '',
                img_path: null
            },
            editingProductId: null
        };
    },
    mounted() {
        this.fetchProducts();
    },
    methods: {
        async fetchProducts() {
            try {
                const response = await axios.get('/api/products');
                this.products = response.data;
            } catch (error) {
                console.error(error);
            }
        },
        openCreateModal() {
            this.isEdit = false;
            this.formData = { title: '', description: '', price: '', stock: '', img_path: null };
            this.showModal = true;
        },
        openEditModal(product) {
            this.isEdit = true;
            this.formData = { ...product };
            this.editingProductId = product.id;
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
        },
        onFileChange(event) {
            this.formData.img_path = event.target.files[0];
        },
        async submitForm() {
            let formData = new FormData();
            for (const key in this.formData) {
                formData.append(key, this.formData[key]);
            }
            
            try {
                if (this.isEdit) {
                    await axios.put(`/api/products/${this.editingProductId}`, formData);
                } else {
                    await axios.post('/api/products', formData);
                }
                this.fetchProducts();
                this.closeModal();
            } catch (error) {
                console.error(error);
            }
        },
        async deleteProduct(productId) {
            try {
                await axios.delete(`/api/products/${productId}`);
                this.fetchProducts();
            } catch (error) {
                console.error(error);
            }
        }
    }
};
</script>

<!-- <template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script> -->
