 
import './bootstrap';   
import { createApp } from 'vue';
import ProductIndex from './components/ProductIndex.vue';

// Create Vue App and mount to #app
const app = createApp({});
app.component('product-index', ProductIndex);
app.mount('#app');
