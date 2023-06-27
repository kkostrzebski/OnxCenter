import Vue from 'vue';
import Router from 'vue-router';
import CustomerList from '@/components/CustomerList.vue';
import CustomerDetails from '@/components/CustomerDetails.vue';

Vue.use(Router);

export default new Router({
  routes: [
    {
      path: '/',
      redirect: '/customers',
    },
    {
      path: '/customers',
      name: 'CustomerList',
      component: CustomerList,
    },
    {
      path: '/customers/:id',
      name: 'CustomerDetails',
      component: CustomerDetails,
    },
  ],
});