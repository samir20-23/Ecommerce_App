import './bootstrap';
import { createApp } from 'vue';
import ProductForm from './components/ProductForm.vue';

const app = createApp({});
app.component('product-form', ProductForm);
app.mount('#app');
