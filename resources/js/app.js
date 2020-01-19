require('./bootstrap');

import $ from 'jquery';
window.$ = window.jQuery = $;

$(document).ready(init);





// Codice per gestione Employee
function init() {
  
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  require('./gestione_company');
  require('./gestione_employee');
  console.log('app.js');
}
