import Chart from './components/Dashboard/Chart.vue';
import Table from './components/Category/Table.vue';
Vue.component('charts', Chart);

new Vue({
  el: '#app-dashboard',
  render: h => h(Chart)
});
