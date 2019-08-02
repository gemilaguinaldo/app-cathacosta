import Vue from 'vue';
import Table from './components/Category/Table.vue';

Vue.component('categories', Table);

new Vue({
  el: '#app-category',
  render: h => h(Table)
});
