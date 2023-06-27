
<template>
  <div>
    <h1>Szczegóły klienta</h1>
    <h2>{{ customer.name }}</h2>
    <p>Pracownik: {{ customer.employee }}</p>
    <p>Ostatnio kupione rzeczy: {{ customer.lastPurchases }}</p>
    <p>Łącznie wydane pieniądze: {{ customer.totalSpent }}</p>
    <p>Samochód: {{ customer.car }}</p>
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
  mounted() {
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