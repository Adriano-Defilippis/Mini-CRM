console.log('gestione_company.js');


   var page = 1;



   // Chiamata ajax per primi 10 risultati Company
   getCompanies(page);
   // Chiamata ajax per primi 10 risultati Employee


   // Azione click su navigazione pagina
   $(document).on('click','.nav_companies', function(e){

     // remove color placeholder
     $('.nav_companies').css('color', '');
     page = $(this).data('page');
     // add color placeholder
     $(this).css('color', 'red');

     // Chiamata ajax per i risultati successivi
     getCompanies(page);


   });

   // Azione tasto back
   $(document).on('click', '.back_btn', function(e){

      getCompanies(page);
   });
   // variabile checked button
   var checked = false;


   // Azione click Add new COMPANY, mostra form
   $(document).on('click', '#add_comp_btn', function(e){

     checked =! checked;
     showFormCreate(checked, page);
   });

   // Azione click invio form creazione company
   $(document).on('click', '#create_comp_btn', function(e){

     // checked =! checked;

     var logo_data = $('#logo_file').get()[0].files[0];
     console.log(logo_data, 'logodata');
     // Form data JS Object
     var formData = new FormData();
     formData.append( '_token', "{{ csrf_token() }}");
     formData.append('name', $('input[name="name"]').val());
     formData.append('email', $('input[name="email"]').val());
     formData.append('website', $('input[name="website"]').val());
     formData.append('logo', logo_data);
     // Call function for redirect ajax page

     var my_this = this;



     console.log('form data', formData);

     // Ajax call to send request to validation on back end
     $.ajax({

       url: '/storecompany',
       type: "POST",
       contentType: false,
       processData: false,
       data: formData,
       success: function(data){

         // Remove form after succes
         $('#add_comp_form').html(

             "New Company Added!"
         );

         var count_items = data[1];
         var last_page = Math.ceil((count_items / 10));
         console.log("data store company ", data);
         console.log('last page', last_page);
         console.log('count_items', count_items);

         // Message succes
         setTimeout(function(){

           // $('#add_comp_form').remove();
           // Refresh dati
           getCompanies(last_page);
           console.log('last page', last_page, data);
         }, 2000);


       },

       error: function(err){

         var message_errors = err.responseJSON.errors;

         // Funzione stampa errori in pagina
         errorMessageForm(message_errors);

         console.log("error",err);
       }
     });

   });

   // Azione click Delete Company
   $(document).on('click', '.btn_delete_comp', function(e){

     var id = $(this).data('id');
     console.log(id);
     destroyCompany(id, page);
     // refreshDelete(page);
   });

   // Azione Edit Company
   $(document).on('click', '.btn_edit_comp', function(e){

     var id_to_edit = $(this).data('id');   

     editCompany(id_to_edit);
   });



   // Azione invio update Company
   $(document).on('click', '#this_btn', function(e){

     var id_toDelete = $(this).data('id');


     updateCompany(id_toDelete, page);
   });

   // Azione submit invio form update logo
   $(document).on('click', '.update_logo_btn', function(e){

     e.preventDefault();
     var id = $(this).data('id');
     var parent = $(this).parent();
     var page = parent.parent().data('page');
     console.log('page', page, id, $(this));
     updateLogo(id,page, e);
   });



   // Mostra nascondi EditForm Company
  function editCompany(id){

    $.ajax({

      url: '/company/edit/' + id,
      success: function(results){


        $('.t_row').each(function(key, value){

          if ($(this).data('id') == id) {

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

  // Function update Company ajax call

  function updateCompany(target_id, page){

    var myThis = this;
    var thisName = $('input[name="name"]').val();
    var thisEmail = $('input[name="email"]').val();
    var thisLogo =  $('input[name="logo"]').val();
    var thisWebsite = $('input[name="website"]').val();
    console.log($('input[name="name"]').val());

    $.ajax({

      url: '/company/update/' + target_id,
      data: {
        "_token": "{{ csrf_token() }}",
          id: target_id,
          name: thisName,
          email: thisEmail,
          logo: thisLogo,
          website:thisWebsite
      },

      config: {
         headers: {
             'Content-Type': 'multipart/form-data'
         }
      },

      success: function(results){

        getCompanies(page);
        console.log(results);
      },
      error: function(err, responseText, tipo, altro, edancora){

        var message_errors = err.responseJSON.errors;

        // Funzione stampa errori in pagina
        errorMessageForm(message_errors);

        console.log(err);
      }

    });
  }

  // Mostra/nascondi Form creazione Company
  function showFormCreate(checked, page){

    // Pulizia div form create company
    $('#add_comp_form').remove();
    $('#create_comp_script').remove();
    console.log(checked);
    // if button is checked
    if (checked) {
      $.ajax({

        url: '/createcompany',
        data: {
          'page' : page
        },
        success: function(data){

          $('.tbody_companies').prepend(data);

          console.log("create form", data, page);

        },
        error: function(err){

        }
      });
    }
  }


  // Function ajax call to Destroy Company
  function destroyCompany(target_id, page){

    var myThis = this;

    $.ajax({

      url: '/company/delete/' + target_id,
      data: {
        "_token": "{{ csrf_token() }}",
          id: target_id
      },
      success: function(results){

        getCompanies(page);
        console.log('success', results);
      },
      error: function(err){
        console.log(err);
      }
    });

  }

  // Funzione per chiamata ajax risultati pagine companies
  function getCompanies(page){

    $.ajax({

      url: '/companies',
      data: {
        'page': page
      },
      success: function(data){

        // Insert rendering page
        $('.card_companies').html(data);

        // Aggiungo colore stile segnaposto pagina
        $('.nav_companies').each(function(key, item){

          if ($(this).text() == page) {

            $(this).css('color', 'red');
          }
          // console.log('page', key, item, $(this).text());
        });

        console.log("log di get company ",data);
      },

      error: function(error){
        console.log("error",error);
      }
    });

  }

  function updateLogo(id, page, e){

      e.preventDefault();
      console.log('click', $(this), id, page);
      var token = $('meta[name="csrf-token"]').attr('content');

      var logo_file = $('#update_logo').get()[0].files[0];
      // Form data JS Object
      var formData = new FormData();
      formData.append( '_token', "{{ csrf_token() }}");
      formData.append('logo', logo_file);

      $.ajax({

        url: '/upload/' + id,
        type: "POST",
        contentType: false,
        processData: false,
        data: formData,
        success: function(data){

          console.log("data", data);
          // Insert rendering page
          $('.card_companies').html(data);
          // e.preventDefault();
          getCompanies(page);
          console.log('data_page', page);
        },

        error: function(err){

          var message_errors = err.responseJSON.errors;
          errorMessageForm(message_errors);
          console.log(err, 'error');
        }
      });

  }

  // Funzione gestione errori request form
  function errorMessageForm(obj){

    for (const property in obj) {

      var mess_arr = obj[property];
      var str = '<div>';

      for (var i = 0; i < mess_arr.length; i++) {

        str += '<p class="font-weight-bold">' + mess_arr[i] + '</p>';

        $('input[name='+ property +']').parent().addClass('border border-danger');
      }

      str += '</div>';
      $('input[name='+ property +']').parent().append(str);

    }
  }
