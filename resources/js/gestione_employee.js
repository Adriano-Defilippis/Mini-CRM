var page_emp = 1;
// Chiamata primi 10 risultati
getEmployees(page_emp);

// Azione click su navigazione pagina
$(document).on('click','.nav_employees', function(){

  page_emp = $(this).data('page');
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
      "_token": "{{ csrf_token() }}",
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


      $('.t_row_emp').each(function(key, value){

        if ($(this).data('id') == target_id) {

          $(this).html(results);
        }
      });
      console.log('edit ajax company', results);
    },
    error: function(err){
      console.log(err);
    }
  });
}
