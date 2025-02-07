// resources/js/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from '../components/Dashboard/Content.vue';
import ProductIndex from '../components/Dashboard/ProductIndex.vue';
import ProductEdit from '../components/Dashboard/editProduct.vue';
import NotFound from '../components/404/404.vue';
import Home from '../components/Home.vue';
import About from '../components/About.vue';

const routes = [
  { path: '/', component: Home },
  { path: '/about', component: About },
  { path: '/dashboard', name: 'Dashboard', component: Dashboard },
  { path: '/dashboard/produits', name: 'Produits', component: ProductIndex },
  { path: '/dashboard/produit/:id/edit', component: ProductEdit },
  { path: '/dashboard/:pathMatch(.*)*', name: 'NotFound', component: NotFound }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
