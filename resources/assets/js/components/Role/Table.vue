<template>
	<div class="card">
		<div class="card-header">
			<h3>Roles</h3>
			<div class="float-right">
				<button class="btn btn-blue" @click="openForm('create', null)"><i class="fa fa-plus" aria-hidden="true"></i> Add Role</button>
			</div>
		</div>
		<div class="card-body">
			<table class="table table-bordered table-striped" id="accounts-datatable">
				<thead>
					<tr>
						<th>Name</th>
						<th>Display Name</th>
						<th>Description</th>
						<th>Status</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="role in roles" :key="role.id">
						<td>{{ role.name }}</td>
						<td>{{ role.display_name }}</td>
						<td>{{ role.description }}</td>
						<td>{{ role.role_status }}</td>
						<td class="text-center">
							<button class="btn btn-sm btn-amber" @click="openForm('edit', role.id)" :disabled="role.id == 1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
							<button class="btn btn-sm btn-red" @click="openDeleteModal('delete', role.id)" :disabled="role.status == 0 || role.id == 1"><i class="fa fa-window-close-o" aria-hidden="true"></i></button>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="pagination mt-20 text-center">
				<button class="btn btn-blue" @click="fetchData(pagination.prev_page_url)" :class="[{'btn-grey': !pagination.prev_page_url}]" :disabled="!pagination.prev_page_url">Prev</button>
				<button class="btn btn-blue" disabled>Page {{ pagination.current_page }} of {{ pagination.last_page }}</button>
				<button class="btn btn-blue"  @click="fetchData(pagination.next_page_url)" :class="[{'btn-grey': !pagination.next_page_url}]" :disabled="!pagination.next_page_url">Next</button>
			</div>

		</div>
		<form-modal ref="formModal"></form-modal>
		<modal ref="modal"></modal>
		<alert ref="alert"></alert>
	</div>
</template>

<script>
import axios from 'axios';
import formModal from './Form.vue';
import modal from '../Modal.vue';
import alert from '../Alert.vue';

export default {
	components: {
		'form-modal' : formModal,
		'modal' : modal,
		'alert' : alert,
	},
	data() {
		return {
			roles: [],
			pagination: {
				prev_class: '',
				next_class: '',
			},
		}
	},

	created() {
		this.fetchData();
	},

	methods: {
		fetchData(page_url) {
			let self = this;
			page_url = page_url || `/roles/getRoles?page=${self.pagination.current_page}`
			axios.get(page_url)
			.then(res => {
				let result = res.data.roles;
				self.roles = result.data;
				self.makePagination(result);
			})
			.catch(err => console.log(err) );
		},
		makePagination(links) {
			let pagination = {
				current_page: links.current_page,
				last_page: links.last_page,
				next_page_url: links.next_page_url,
				prev_page_url: links.prev_page_url,
			}
			this.pagination = pagination;
		},
		openForm(type, id) {
			(type == 'create') ? this.$refs.formModal.createRole() : this.$refs.formModal.editRole(id);
		},
		openDeleteModal(type, id) {
			this.$refs.modal.init(id, `/roles/${id}`, type, 'Role Status', 'Are you sure to set this role to inactive?', 'yesNo');
		},
		makeAlert(type, strong, content) {
			this.$refs.alert.alertNotify(type, strong, content);
		},

	}

}
</script>