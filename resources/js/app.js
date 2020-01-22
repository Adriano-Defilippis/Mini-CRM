/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
// Vue.component('tr-employees', require('./components_vue/employee_tablerow.blade.php').default);
Vue.component('employee');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import $ from 'jquery';
window.$ = window.jQuery = $;

$(document).ready(init);





// Codice per gestione Employee
function init() {

  const app = new Vue({
      el: '#employee-vue',
  });

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Vue.component('tr_employee');
  require('./gestione_company');
  require('./gestione_employee');
  require('./gestione_show_company');
  console.log('app.js');
}
