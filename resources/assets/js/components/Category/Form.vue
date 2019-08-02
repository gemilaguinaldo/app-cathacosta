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
							<p>Name</p>
							<input type="text" class="input-element" v-model="category.name" required autofocus>
						</div>
						<div class="input-wrapper">
							<p>Description</p>
							<textarea class="input-element" v-model="category.description" rows="3"></textarea>
						</div>
						<div class="input-wrapper">
							<p>Status</p>
							<select class="input-element" v-model="category.status" required>
								<option value="1">Active</option>
								<option value="0">Inactive</option>
							</select>
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
			category: {
				name: '',
				description: '',
				status: 1,
			},
			showError: false,
			errors: [],
			category_id: null,
			buttonSubmit: '',

		}
	},

	mounted() {
		// this.$el.addEventListener('click', this.onClose);
	},

	methods: {
		createCategory() {
			let self = this;
			self.clearForm();
			self.title = 'Add Category';
			self.buttonSubmit = 'Save';
			self.showModal = true;
		},
		storeCategory() {
			let self = this;
			axios.post('/expense-categories', self.category)
			.then(data => {
				let res = data.data;
				if (res.result) {
					self.showModal = false;
					self.clearForm();
					self.$parent.makeAlert('success', '', 'Expense Category successfully created!')
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

		editCategory(id) {
			fetch(`expense-categories/${id}`) 
			.then(res => res.json() )
			.then(res => {
				let self = this;
				self.clearForm();
				self.edit = true;
				self.title = 'Update Expense Category';
				self.buttonSubmit = 'Update';
				self.showModal = true;
				self.category_id = id;
				self.category = res;
			})
			.catch(err => console.log(err) );
		},
		updateCategory(id) {
			let self = this;
			axios.put(`/expense-categories/${id}`, self.category)
			.then(data => {
				console.log(data);
				let res = data.data;
				if(res.result)
				{
					self.clearForm();
					self.showModal = false;
					self.$parent.makeAlert('success', '', 'Expense Category successfully updated!');
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
			this.category_id = null;
			this.category = {
				name: '',
				description: '',
				status: 1,
			};
			this.edit = false;
			this.title = '';
			this.buttonSubmit = '';
			this.showError = false;
		},

		submitForm() {
			(this.edit == true) ? this.updateCategory(this.category_id) : this.storeCategory();
		},


	}, // end methods

}
</script>