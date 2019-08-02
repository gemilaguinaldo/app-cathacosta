<template>
	<div class="modal" :class="[{'d-block' : showModal}]">
		<div class="modal-content">
			<div class="modal-header text-blue">
				<span class="close" @click="showModal = false">&times;</span>
				<h4 >{{ title }}</h4>
			</div>
			<form @submit.prevent="submitForm">
				<div class="modal-body">
					<div class="alert-fixed error" :class="[{'d-block' : showError}]">
						<strong><i class="icon fa fa-ban"></i> Check Errors!</strong> 
						<ul v-for="error in errors">
							<li>{{ error }}</li>
						</ul>
					</div>
					<div class="input-container">
						<div class="input-wrapper">
							<p>Expense Category</p>
							<select class="input-element" v-model="expense.category_id" required autofocus>
								<option v-for="category in categories" :value="category.id">{{ category.name }}</option>
							</select>
						</div>
						<div class="input-wrapper">
							<p>Amount</p>
							<input type="number" class="input-element" v-model="expense.amount" required>
						</div>
						<div class="input-wrapper">
							<p>Entry Date</p>
							<input type="date" class="input-element" v-model="expense.entry_date" required>
						</div>
						<div class="input-wrapper">
							<p>Note</p>
							<textarea class="input-element" v-model="expense.note" rows="3"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="float-right">
						<button type="button" class="btn btn-grey" @click="showModal = false">Cancel</button>
						<button type="submit" class="btn btn-blue">{{ buttonSubmit }}</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			showModal : false,
			title: '',
			edit: false,
			expense_id: null,
			expense: {
				category_id: '',
				amount: '',
				entry_date: '',
				note: '',
			},
			showError: false,
			errors: [],
			buttonSubmit: ''
		}
	},

	mounted() {
		// this.$el.addEventListener('click', this.onClose);
	},

	props: {
		categories: Array
	},

	methods: {
		createExpense() {
			let self = this;
			self.clearForm();
			self.title = 'Add Expense';
			self.buttonSubmit = 'Save';
			self.showModal = true;
		},
		storeExpense() {
			let self = this;
			axios.post('/expenses', self.expense)
			.then(data => {
				let res = data.data;
				if (res.result) {
					self.showModal = false;
					self.clearForm();
					self.$parent.makeAlert('success', '', 'Expense successfully added!')
					self.$parent.fetchData();
				}
				else {
					self.showError = true;
					self.errors = res.errors;
					self.$parent.makeAlert('error', 'Alert!', 'Please check errors!');
				}

			})
			.catch(err => console.log(err));
		},

		editExpense(id) {
			fetch(`expenses/${id}`) 
			.then(res => res.json() )
			.then(res => {
				let self = this;
				self.clearForm();
				self.edit = true;
				self.title = 'Update Expense';
				self.buttonSubmit = 'Update';
				self.showModal = true;
				self.expense_id = id;
				self.expense = res;
			})
			.catch(err => console.log(err) );
		},
		updateExpense(id) {
			let self = this;
			axios.put(`/expenses/${id}`, self.expense)
			.then(data => {
				let res = data.data;
				if(res.result)
				{
					self.clearForm();
					self.showModal = false;
					self.$parent.makeAlert('success', '', 'Expense successfully updated!');
					self.$parent.fetchData();
				}
				else
				{
					self.showError = true;
					self.errors = res.errors;
					self.$parent.makeAlert('error', 'Alert!', 'Please check errors!');
				}
			})
			.catch(err => console.log(err));
		},

		onClose(e) {
			if (e.target == this.$el) 
				this.showModal = false;
		},

		clearForm() {
			this.expense_id = null;
			this.expense = {
				category_id: '',
				amount: '',
				entry_date: '',
				note: '',
			};
			this.edit = false;
			this.title = '';
			this.buttonSubmit = '';
			this.showError = false;
		},

		submitForm() {
			(this.edit == true) ? this.updateExpense(this.expense_id) : this.storeExpense();
		},

	}, // end methods

}
</script>