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
							<input type="text" class="input-element" v-model="role.name" required autofocus>
						</div>
						<div class="input-wrapper">
							<p>Display Name</p>
							<input type="text" class="input-element" v-model="role.display_name" required>
						</div>
						<div class="input-wrapper">
							<p>Description</p>
							<textarea class="input-element" v-model="role.description" rows="3"></textarea>

						</div>
						<div class="input-wrapper">
							<p>Status</p>
							<select class="input-element"  v-model="role.status" required>
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
			role: {
				name: '',
				display_name: '',
				description: '',
				status: 1,
			},
			showError: false,
			errors: [],
			buttonSubmit: '',
		}
	},

	mounted() {
		// this.$el.addEventListener('click', this.onClose);
	},

	methods: {
		createRole() {
			let self = this;
			self.clearForm();
			self.title = 'Add Role';
			self.buttonSubmit = 'Save';
			self.showModal = true;
		},
		storeRole() {
			let self = this;
			axios.post('/roles', self.role)
			.then(data => {
				let res = data.data;
				if (res.result) {
					self.showModal = false;
					self.clearForm();
					self.$parent.makeAlert('success', '', 'Role successfully created!')
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

		editRole(id) {
			fetch(`roles/${id}`)
			.then(res => res.json() )
			.then(res => {
				let self = this;
				self.clearForm();
				self.edit = true;
				self.title = 'Update Role';
				self.buttonSubmit = 'Update';
				self.showModal = true;
				self.role_id = id;
				self.role = res;
			})
			.catch(err => console.log(err) );
		},
		updateRole(role_id) {
			let self = this;
			axios.put(`/roles/${role_id}`, self.role)
			.then(data => {
				let res = data.data;
				if(res.result)
				{
					self.clearForm();
					self.showModal = false;
					self.$parent.makeAlert('success', '', 'Role successfully updated!');
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
			this.role_id = null;
			this.role = {
				name: '',
				display_name: '',
				description: '',
				status: 1,
			};
			this.edit = false;
			this.title = '';
			this.buttonSubmit = '';
			this.showError = false;
		},

		submitForm() {
			(this.edit == true) ? this.updateRole(this.role_id) : this.storeRole();
		},


	}, // end methods

}
</script>