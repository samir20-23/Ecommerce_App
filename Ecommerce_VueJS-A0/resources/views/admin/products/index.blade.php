<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
</head>
<body>
    <h1>Product Management</h1>

    <a href="{{ route('products.create') }}">Create Product</a>

    <div id="app">
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
                        <a :href="'/products/' + product.id + '/edit'">Edit</a>
                        <form :action="'/products/' + product.id" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>

        <div v-if="pagination.total > 0">
            <button @click="changePage(pagination.current_page - 1)" :disabled="pagination.current_page === 1">Previous</button>
            <button @click="changePage(pagination.current_page + 1)" :disabled="pagination.current_page === pagination.last_page">Next</button>
        </div>
    </div>

    <script>
        new Vue({
            el: '#app',
            data() {
                return {
                    products: [],
                    pagination: {}
                };
            },
            created() {
                this.fetchProducts(1); // Fetch products when the page loads
            },
            methods: {
                fetchProducts(page) {
                    fetch(`/products?page=${page}`)
                        .then(response => response.json())
                        .then(data => {
                            this.products = data.data;
                            this.pagination = data;
                        })
                        .catch(error => console.log(error));
                },
                changePage(page) {
                    if (page >= 1 && page <= this.pagination.last_page) {
                        this.fetchProducts(page);
                    }
                }
            }
        });
    </script>
</body>
</html>
