import { createRouter, createWebHistory } from 'vue-router';

// Import your components
import HomePage from './components/HomePage.vue';
import ProductList from './components/ProductList.vue';

const routes = [
  { path: '/', component: HomePage },
  { path: '/products', component: ProductList },
  // Add more routes here
];

const router = createRouter({
  history: createWebHistory(),
  routes, // short for `routes: routes`
});

export default router;
