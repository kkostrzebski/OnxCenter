import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../views/Home.vue';
import CustomerList from '../components/CustomerList.vue';
import CustomerDetails from '../components/CustomerDetails.vue';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/customers',
    name: 'CustomerList',
    component: CustomerList
  },
  {
    path: '/customer/:id',
    name: 'CustomerDetails',
    component: CustomerDetails
  }
];

const router = new VueRouter({
  mode: 'history',
  routes
});

export default router;