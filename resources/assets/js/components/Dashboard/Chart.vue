<template>
	<div class="card center-60">
		<div class="card-header">
			<h3>My Expenses</h3>
		</div>
		<div class="card-body">
			<div class="input-container w-100 text-center">
				<div class="input-wrapper d-inline">
					<p><small>Start Date</small></p>
					<input type="date" class="input-element " v-model="start_date" required>
				</div>
				<div class="input-wrapper d-inline">
					<p><small>End Date</small></p>
					<input type="date" class="input-element " v-model="end_date" required>
				</div>
				<div class="d-inline">
					<button class="btn btn-blue d-inline" @click="fetchData">Submit</button>
				</div>
			</div>
			<div class="w-60 mt-30 mb-30 ml-20 text-center">
				<GChart
					type="PieChart"
					:data="chartData"
					:options="chartOptions"
				/>
			</div>
		</div>
	</div>
</template>
<script>
import { GChart } from 'vue-google-charts';
export default {
	components: {
		GChart
	},
	data () {
		return {
			chartDataHeader:  ['Category', 'Amount', 'Percentage'],
			updatedChartData: [],
			start_date : null,
			end_date: null,
			url: '',
			chartOptions: {
				chart: {
					title: 'My Expenses',
				},
				width: '100%',
    			height: '100%',
    			chartArea: {left: 0, top: 0, width: "100%", height: "100%"},
			},
		}
	},

	created() {
		this.fetchData();
	},

	computed: {
		chartData() {
			return [this.chartDataHeader, ...this.updatedChartData];
		}
	},

	methods: {
		fetchData() {
			let self = this;
			if(self.start_date == null || self.end_date == null)
				self.url = '/getExpensesData';
			else
				self.url = `/getExpensesData/${self.start_date}/${self.end_date}`;
			axios.get(self.url)
			.then(res => {
				this.updatedChartData = res.data.expenses;
				this.start_date = res.data.start_date;
				this.end_date = res.data.end_date;
			})
			.catch(err => console.log(err) );
		},
	},

}

</script>