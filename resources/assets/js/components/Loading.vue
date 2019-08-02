<template>
	<div class="loading-div" v-if="showLoading">
		<img src="./images/loading.svg">
	</div>
</template>
<script>
	export default {
		data() {
			return {

			}
		},
		props: {
			showLoading: Boolean
		}
	}
</script>