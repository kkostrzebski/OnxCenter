<template>
  <div>
    <h1>Lista klientów</h1>
    <div>
      <label>
        Sortuj według:
        <select v-model="sortOption">
          <option value="">-- Wybierz opcję --</option>
          <option value="firstName">Imię</option>
          <option value="lastName">Nazwisko</option>
        </select>
      </label>
      <label>
        Filtruj według imienia:
        <input type="text" v-model="filterQuery" />
      </label>
      <label>
        Wyszukaj:
        <input type="text" v-model="searchQuery" />
      </label>
    </div>
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
        <tr v-for="customer in paginatedCustomers" :key="customer.id">
          <td>{{ customer.id }}</td>
          <td>{{ customer.firstName }}</td>
          <td>{{ customer.lastName }}</td>
          <td>
            <router-link :to="'/customer/' + customer.id">Szczegóły</router-link>
            <button @click="deleteCustomer(customer.id)">Usuń</button>
            <button @click="editCustomer(customer.id)">Edytuj</button>
          </td>
        </tr>
      </tbody>
    </table>
    <div>
      <button :disabled="currentPage === 1" @click="previousPage">Poprzednia strona</button>
      <button :disabled="currentPage === totalPages" @click="nextPage">Następna strona</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      customers: [],
      sortOption: '',
      filterQuery: '',
      searchQuery: '',
      currentPage: 1,
      pageSize: 10
    };
  },
  computed: {
    filteredCustomers() {
      let filtered = this.customers;

      // Filtrowanie po imieniu
      if (this.filterQuery) {
        filtered = filtered.filter(customer =>
          customer.firstName.toLowerCase().includes(this.filterQuery.toLowerCase())
        );
      }

      // Wyszukiwanie ogólne
      if (this.searchQuery) {
        filtered = filtered.filter(customer =>
          Object.values(customer).some(
            value => value && value.toString().toLowerCase().includes(this.searchQuery.toLowerCase())
          )
        );
      }

      // Sortowanie
      if (this.sortOption) {
        filtered = filtered.sort((a, b) =>
          a[this.sortOption].localeCompare(b[this.sortOption])
        );
      }

      return filtered;
    },
    paginatedCustomers() {
      const startIndex = (this.currentPage - 1) * this.pageSize;
      const endIndex = startIndex + this.pageSize;
      return this.filteredCustomers.slice(startIndex, endIndex);
    },
    totalPages() {
      return Math.ceil(this.filteredCustomers.length / this.pageSize);
    }
  },
  created() {
    this.fetchCustomers();
  },
  methods: {
    fetchCustomers() {
      // Pobierz listę klientów z serwera
      axios.get('/api/customers')
        .then(response => {
          this.customers = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    previousPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    },
    deleteCustomer(customerId) {
      if (confirm('Czy na pewno chcesz usunąć tego klienta?')) {
        axios.delete(`/api/customers/${customerId}`)
          .then(() => {
            this.fetchCustomers();
            alert('Klient został usunięty!');
          })
          .catch(error => {
            console.error(error);
          });
      }
    },
    editCustomer(customerId) {
      // Przekieruj do formularza edycji klienta
      this.$router.push(`/customer/edit/${customerId}`);
    }
  }
};
</script>