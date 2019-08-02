import Vue from 'vue';
import Table from './components/Role/Table.vue';

Vue.component('roles', Table);

new Vue({
  el: '#app-role',
  render: h => h(Table)
});
