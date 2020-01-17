require('./bootstrap');

import $ from 'jquery';
window.$ = window.jQuery = $;

$(document).ready(init);


var token = $('meta[name="csrf-token"]').attr('content');
