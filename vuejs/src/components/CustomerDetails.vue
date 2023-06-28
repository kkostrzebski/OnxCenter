<template>
  <div v-if="customer">
    <h1>Szczegóły klienta</h1>
    <h2>{{ customer.firstName }} {{ customer.lastName }}</h2>
    <p>Pracownik: {{ customer.employee }}</p>
    <p>Ostatnio kupione rzeczy: {{ customer.recentPurchases }}</p>
    <p>Łączna wartość zakupów: {{ customer.totalSpent }}</p>
    <p>Samochód: {{ customer.car }}</p>
  </div>
  <div v-else>
    <p>Ładowanie danych...</p>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      customer: null,
    };
  },
  created() {
 
    this.fetchCustomer();
  },
  methods: {
    fetchCustomer() {
      const customerId = this.$route.params.id;
      axios.get(`/api/customers/${customerId}`)
        .then(response => {
          this.customer = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
  },
};
</script>