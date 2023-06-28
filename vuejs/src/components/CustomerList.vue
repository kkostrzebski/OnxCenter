<template>
  <div>
    <h1>Lista klientów</h1>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Imię</th>
          <th>Nazwisko</th>
          <th>Akcje</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="customer in customers" :key="customer.id">
          <td>{{ customer.id }}</td>
          <td>{{ customer.firstName }}</td>
          <td>{{ customer.lastName }}</td>
          <td>
            <router-link :to="'/customer/' + customer.id">Szczegóły</router-link>
          </td>
        </tr>
      </tbody>
    </table>
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
  created() {

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