<template>
  <div>
    <h1>Lista klientów</h1>
    <ul>
      <li v-for="customer in customers" :key="customer.id">
        <router-link :to="`/customers/${customer.id}`">{{ customer.name }}</router-link>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      customers: [],
    };
  },
  mounted() {
    this.fetchCustomers();
  },
  methods: {
    fetchCustomers() {
      axios.get('/api/customers')
        .then(response => {
          this.customers = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
  },
};
</script>