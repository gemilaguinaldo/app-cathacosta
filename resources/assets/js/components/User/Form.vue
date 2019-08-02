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
							<p>Email</p>
							<input type="email" class="input-element" v-model="user.email" required autofocus>
						</div>
						<div class="input-wrapper">
							<p>First Name</p>
							<input type="text" class="input-element" v-model="user.firstname" required>
						</div>
						<div class="input-wrapper">
							<p>Last Name</p>
							<input type="text" class="input-element" v-model="user.lastname" required>
						</div>
						<div class="input-wrapper">
							<p>Role</p>
							<select class="input-element"  v-model="user.role_id" required>
								<option v-for="role in roles" :value="role.id">{{ role.display_name }}</option>
							</select>
						</div>
						<div class="input-wrapper">
							<p>Status</p>
							<select class="input-element"  v-model="user.status" required>
								<option value="1">Active</option>
								<option value="0">Inactive</option>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="float-right">
						<button type="button" class="btn btn-grey" @click="showModal = false">Cancel</button>
						<button type="submit" class="btn btn-blue" :disabled="!enableButton">{{ buttonSubmit }}</button>
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
			user: {
				email: '',
				firstname: '',
				lastname: '',
				status: '',
				role_id: '',
			},
			showError: false,
			errors: [],
			user_id: null,
			buttonSubmit: '',
			enableButton: true
		}
	},

	props : {
		roles: Array,
	},

	mounted() {
		// this.$el.addEventListener('click', this.onClose);
	},

	methods: {
		createUser() {
			let self = this;
			self.clearForm();
			self.title = 'Add User';
			self.buttonSubmit = 'Save';
			self.showModal = true;
		},
		storeUser() {
			let self = this;
			self.enableButton = false;
			axios.post('/users', self.user)
			.then(data => {
				let res = data.data;
				if (res.result) {
					self.showModal = false;
					self.$parent.makeAlert('success', '', 'User successfully created! Credentials has been sent via email.')
					self.clearForm();
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

		editUser(id) {
			fetch(`users/${id}`)
			.then(res => res.json() )
			.then(res => {
				let self = this;
				self.clearForm();
				self.edit = true;
				self.title = 'Update User';
				self.buttonSubmit = 'Update';
				self.showModal = true;
				self.user_id = id;
				self.user = res;
			})
			.catch(err => console.log(err) );
		},
		updateUser(id) {
			let self = this;
			axios.put(`/users/${id}`, self.user)
			.then(data => {
				let res = data.data;
				if(res.result)
				{
					self.clearForm();
					self.showModal = false;
					self.$parent.makeAlert('success', '', 'User successfully updated!');
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
			this.title = '';
			this.edit = false;
			this.user = {
				email: '',
				firstname: '',
				lastname: '',
				status: 1,
				role_id: '',
			};
			this.showError = false;
			this.enableButton = true;
			this.errors = [];
			this.user_id = null;
		},

		submitForm() {
			(this.edit == true) ? this.updateUser(this.user_id) : this.storeUser();
		},


	}, // end methods

}
</script>