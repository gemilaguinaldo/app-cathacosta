import Vue from 'vue';
import Table from './components/Expense/Table.vue';

Vue.component('expenses', Table);

new Vue({
  el: '#app-expense',
  render: h => h(Table)
});
