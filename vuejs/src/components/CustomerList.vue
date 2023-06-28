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
						<button @click="editCustomer(customer.id)">Edytuj</button>
						<button @click="deleteCustomer(customer.id)">Usuń</button>
					</td>
				</tr>
			</tbody>
		</table>
		<h2>Dodaj nowego klienta</h2>
		<form @submit.prevent="addCustomer">
			<label>
				Imię:
				<input type="text" v-model="newCustomer.firstName" required />
			</label>
			<label>
				Nazwisko:
				<input type="text" v-model="newCustomer.lastName" required />
			</label>
			<button type="submit">Dodaj klienta</button>
		</form>
		<h2>Edytuj klienta</h2>
		<form v-if="editingCustomer" @submit.prevent="updateCustomer">
			<label>
				Imię:
				<input type="text" v-model="editingCustomer.firstName" required />
			</label>
			<label>
				Nazwisko:
				<input type="text" v-model="editingCustomer.lastName" required />
			</label>
			<button type="submit">Zapisz zmiany</button>
			<button @click="cancelEdit">Anuluj</button>
		</form>
	</div>
</template>

<script>
import axios from 'axios'

export default {
	data() {
		return {
			customers: [],
			newCustomer: {
				firstName: '',
				lastName: '',
			},
			editingCustomer: null,
		}
	},
	created() {
		this.fetchCustomers()
	},
	methods: {
		fetchCustomers() {
			axios
				.get('/api/customers')
				.then(response => {
					this.customers = response.data
				})
				.catch(error => {
					console.error(error)
				})
		},
		addCustomer() {
			if (!this.newCustomer.firstName || !this.newCustomer.lastName) {
				alert('Wprowadź imię i nazwisko klienta!')
				return
			}

			axios
				.post('/api/customers', this.newCustomer)
				.then(response => {
					this.customers.push(response.data)
					this.newCustomer.firstName = ''
					this.newCustomer.lastName = ''
				})
				.catch(error => {
					console.error(error)
				})
		},
		deleteCustomer(customerId) {
			if (confirm('Czy na pewno chcesz usunąć tego klienta?')) {
				axios
					.delete(`/api/customers/${customerId}`)
					.then(() => {
						this.customers = this.customers.filter(customer => customer.id !== customerId)
						alert('Klient został usunięty!')
					})
					.catch(error => {
						console.error(error)
					})
			}
		},
		editCustomer(customerId) {
			this.editingCustomer = this.customers.find(customer => customer.id === customerId)
		},
		updateCustomer() {
			if (!this.editingCustomer.firstName || !this.editingCustomer.lastName) {
				alert('Wprowadź imię i nazwisko klienta!')
				return
			}

			axios
				.put(`/api/customers/${this.editingCustomer.id}`, this.editingCustomer)
				.then(response => {
					const updatedCustomer = response.data
					const index = this.customers.findIndex(customer => customer.id === updatedCustomer.id)
					if (index !== -1) {
						this.customers.splice(index, 1, updatedCustomer)
						this.editingCustomer = null
						alert('Klient został zaktualizowany!')
					}
				})
				.catch(error => {
					console.error(error)
				})
		},
		cancelEdit() {
			this.editingCustomer = null
		},
	},
}
</script>
