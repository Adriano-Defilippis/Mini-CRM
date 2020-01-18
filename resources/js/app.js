require('./bootstrap');

import $ from 'jquery';
window.$ = window.jQuery = $;

$(document).ready(init);





// Codice per gestione Employee
function init() {

  require('./gestione_company');
  require('./gestione_employee');
  var token = $('meta[name="csrf-token"]').attr('content');
  console.log('app.js');
}
