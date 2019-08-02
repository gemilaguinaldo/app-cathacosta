import Info from './components/Profile/Info.vue';
import Security from './components/Profile/Security.vue';

Vue.component('information', Info);
Vue.component('security', Security);

new Vue({
  el: '#app-profile',
  components: {
  	'information' : Info,
  	'security' : Security
  }
});
