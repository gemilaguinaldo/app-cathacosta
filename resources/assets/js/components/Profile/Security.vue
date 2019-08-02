<template>
	<div class="card center-60">
		<div class="card-header">
			<h5>Change Password</h5>
			<div class="float-right">
				<button class="btn btn-sm-text btn-grey " @click="edit = true" v-if="!edit"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button>
			</div>
		</div>
		<form @submit.prevent="submitForm">
			<div class="card-body" v-if="edit">
				<div class="alert-fixed error" :class="[{'d-block' : showError}]">
					<strong><i class="icon fa fa-ban"></i> Check Errors!</strong> 
					<ul v-for="error in errors">
						<li>{{ error }}</li>
					</ul>
				</div>
				<div class="input-container">
					<div class="input-wrapper">
						<p>Current</p>
						<input type="password" class="input-element" v-model="passwordData.password" required autofocus>
					</div>
					<div class="input-wrapper">
						<p>New</p>
						<input type="password" class="input-element" v-model="passwordData.new_password" required>
					</div>
					<div class="input-wrapper">
						<p>Re-type new</p>
						<input type="password" class="input-element" v-model="passwordData.password_confirmation" required>
					</div>
				</div>
			</div>
			<div class="card-footer " v-if="edit">
				<div class="float-right">
					<button type="button" class="btn btn-sm-text btn-grey" @click="clearForm">Cancel</button>
					<button type="submit" class="btn btn-sm-text btn-blue">Save Changes</button>
				</div>
			</div>
		</form>
		<alert ref="alert"></alert>
	</div>
</template>

<script>
import axios from 'axios';
import alert from '../Alert.vue';

export default {
	components: {
		'alert' : alert
	},
	data() {
		return {
			edit : false,
			showError : false,
			errors: [],
			passwordData: {
				password: '',
				new_password: '',
				password_confirmation: '',
			}
		}
	},

	methods: {
		clearForm() {
			this.passwordData = {
				password: '',
				new_password: '',
				password_confirmation: '',
			};
			this.showError = false;
			this.edit = false;
			this.errors = [];
		},

		submitForm() {
			let self = this;
			axios.post('/profile/change-password', self.passwordData)
			.then(data => {
				console.log(data);
				let res = data.data;
				if (res.result) {
					self.makeAlert('success', '', 'Password changed successfully!')
					self.clearForm();
				}
				else {
					self.showError = true;
					self.errors = res.errors;
					self.makeAlert('error', 'Alert!', 'Please check errors!');
				}
			})
			.catch(err => console.log(err));
		},

		makeAlert(type, strong, content) {
			this.$refs.alert.alertNotify(type, strong, content);
		},

	}

}
</script>