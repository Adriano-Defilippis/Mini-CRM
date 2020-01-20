var page_emp = 1;
// Chiamata primi 10 risultati
getEmployees(page_emp);

// Azione Search Bar
$(document).on('keyup', '#search_employee', function(e){

  var query_emp = $('#search_employee').val();
  if (query_emp.length > 0) {
    console.log("LOOOOGGGG");

    liveSearchEmployee(page_emp)
  }else {

    getEmployees(page_emp);
  }
});

// Azione click su navigazione pagina
$(document).on('click','.nav_employees', function(){

  page_emp = $(this).data('page');
  liveSearchEmployee(page_emp);
  // Chiamata ajax per i risultati successivi
  getEmployees(page_emp);
});

// Azione click su delete Employee
$(document).on('click', '.btn_delete_empl', function(e){

  var id = $(this).data('id');

  destroyEmployee(id, page_emp);

});

// Azione Edit Employee
$(document).on('click', '.btn_edit_empl', function(e){

  var id_to_edit = $(this).data('id');

  editEmployee(id_to_edit);
});

// Azione invio update Employee
$(document).on('click', '#update_employee', function(e){

  var id_toDelete = $(this).data('id');


  updateEmployee(id_toDelete, page_emp);
});

// Azione tasto back_btn
$(document).on('click', '.back_btn_emp', function(e){

  getEmployees(page_emp);
});

// Funzione per chiamata ajax risultati pagine companies
function getEmployees(page){

  $.ajax({

  url: '/employees',
  data: {
    'page': page
  },
  success: function(results){

    // Insert rendering page
    $('.card_employees').html(results);

    // Aggiungo colore stile segnaposto pagina
    $('.nav_employees').each(function(key, item){

      if ($(this).text() == page) {

        $(this).css('color', 'red');
      }
      // console.log('page', key, item, $(this).text());
    });

    console.log("log di employy ",results);
  },

  error: function(error){
    console.log("error",error);
  }
  });
}

// Function ajax call to Destroy Employee
function destroyEmployee(target_id, page){

  var myThis = this;

  $.ajax({

    url: '/employee/delete/' + target_id,
    data: {
      "_token": $('meta[name="csrf-token"]').attr('content'),
        id: target_id
    },
    success: function(results){

      getEmployees(page);
      console.log('success', results);
    },
    error: function(err){
      console.log(err);
    }
  });

}

// Function to get Edit Form Ajax CALL
function editEmployee(target_id){

  $.ajax({

    url: '/employee/edit/' + target_id,
    success: function(results){


      $('tr[employee-id="'+ target_id +'"]').html(results);
      console.log('edit ajax company', results);
    },
    error: function(err){
      console.log(err);
    }
  });
}

// Function to send Update Employee Ajax Call
function updateEmployee(target_id, page_emp){

  // var thisFirstName = $('input[name="first_name"]').val();
  // var thisLastName = $('input[name="last_name"]').val();
  // var thisCompany =  $('select[name="company"]').val();
  // var thisEmail = $('input[name="email"]').val();
  // var thisPhone = $('input[name="phone"]').val();

  var formUpdate = new FormData();
  formUpdate.append( '_token', $('meta[name="csrf-token"]').attr('content'));
  formUpdate.append('first_name', $(' tr[employee-id="' + target_id +'"] th input[name="first_name"]').val());
  formUpdate.append('last_name', $(' tr[employee-id="' + target_id +'"] td input[name="last_name"]').val());
  formUpdate.append('company_id', parseInt($(' tr[employee-id="' + target_id +'"] td select[name="company"]').val()));
  formUpdate.append('email', $(' tr[employee-id="' + target_id +'"] td input[name="email"]').val());
  formUpdate.append('phone', $(' tr[employee-id="' + target_id +'"] td input[name="phone"]').val());

    console.log("form update", formUpdate);

  $.ajax({

    url: '/employee/update/' + target_id,
    data: formUpdate,
    type: "POST",
    contentType: false,
    processData: false,
    success: function(results){

      // getEmployees(page_emp);
      refreshEmployeeTr(target_id);
      console.log(results);
    },
    error: function(err){

      var message_errors = err.responseJSON.errors;

      // Funzione stampa errori in pagina
      errorMessageForm(message_errors);

      console.log(err);
    }

  });
}

// Funzione gestione errori request form
function errorMessageForm(obj){

  for (const property in obj) {

    var mess_arr = obj[property];
    var str = '<div>';
    var target = $('input[name='+ property +']');

    if (property == 'company') {
      target = $('select[name='+ property +']');
    }

    for (var i = 0; i < mess_arr.length; i++) {

      str += '<p class="font-weight-bold">' + mess_arr[i] + '</p>';

      target.parent().addClass('border border-danger');
    }

    str += '</div>';
    target.parent().append(str);

  }
}

// Funzione per refresh singolo item dopo update
function refreshEmployeeTr(myId){

  $.ajax({

    url: '/refresh/employee/' + myId,
    dataType: "JSON",
    success: function(results){

      // Insert rendering page
      $('tr[employee-id="' + myId +'"]').html(results);
      console.log('refresh', results);

    },
    error: function(err){

      console.log(err);
    }
  });
}

// Function to lieve search results
function liveSearchEmployee(mypage, placeholder){

  var liveQueryEmployee = $('#search_employee').val();
  // console.log(liveQuery);
  $('#search_emp_mess').hide();

  console.log('live search');
  $.ajax({

    url: '/search/employee',
    data: { query : liveQueryEmployee, page:  mypage},
    // dataType: "JSON",
    success: function(results){

        console.log('live search success', results);
      // Controllo presenza messsaggi
      var message = results.message;
      if (message) {
        $('#search_emp_mess').fadeIn(1000);
        $('#search_emp_mess li').text(message);
        console.log('live search', results, results.message, $('.employee_tbody'));
      }

      // Insert rendering page
      $('.card_employees').html(results.html);
      // add color placeholder
      // placeholder.css('color', 'red');
    },
    error: function(err){

      console.log(err);
    }
  });
}
