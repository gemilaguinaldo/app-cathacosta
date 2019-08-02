<template>
	<div class="card center-60">
		<div class="card-header">
			<h5>Profile Information</h5>
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
				</div>
			</div>
			<div class="card-footer " v-if="edit">
				<div class="float-right">
					<button type="button" class="btn btn-sm-text btn-grey" @click="edit = false">Cancel</button>
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
			user: {
				email : '',
				firstname : '',
				lastname : '',
			}
		}
	},

	created() {
		this.fetchData();
	},

	methods: {
		fetchData() {
			let self = this;
			axios.get(`/users/${Laravel.userId}`)
			.then(res => {
				let result = res.data;
				self.user.email = result.email;
				self.user.firstname = result.firstname;
				self.user.lastname = result.lastname;
			})
			.catch(err => console.log(err) );
		},

		submitForm() {
			let self = this;
			axios.post('/profile/edit-profile', self.user)
			.then(data => {
				let res = data.data;
				if (res.result) {
					self.edit = false;
					self.showError = false;
					self.makeAlert('success', '', 'Profile successfully updated!')
					self.fetchData();
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