import Vue from 'vue';
import Table from './components/User/Table.vue';

Vue.component('users', Table);

new Vue({
  el: '#app-user',
  render: h => h(Table)
});
