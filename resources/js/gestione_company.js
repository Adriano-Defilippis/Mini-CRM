console.log('gestione_company.js');

  // Pulisco campo input #search_company
    $('#search_company').val('');
   var page = 1;



   // Chiamata ajax per primi 10 risultati Company
   getCompanies(page);
   // Chiamata ajax per primi 10 risultati Employee

   // Azione Search Bar
   $(document).on('keyup', '#search_company', function(e){

     var query = $('#search_company').val();
     if (query.length > 0) {
       liveSearchCompany(page);
     }else {
       getCompanies(page);
     }
   })

   // Azione click su navigazione pagina
   $(document).on('click','.nav_companies', function(e){

     // remove color placeholder
     // $('.nav_companies').css('color', '');
     console.log('log',$(this).data('type'));

     if ($(this).data('type') == 'search_comp_paginate') {

      var page_search = $(this).data('page');
      // Chiamata Ajax per risultati successivi ricerca dati
      liveSearchCompany(page_search);
       console.log('data.type', $(this));
     }else {

       // Chiamata ajax per i risultati successivi
       getCompanies(page);
     }

     // add color placeholder
     $(this).css('color', 'red');
     console.log();




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
     console.log($('meta[name="csrf-token"]').attr('content'));
     var logo_data = $('#logo_file').get()[0].files[0];
     var myParent = $(this).parent();
     var target_id = myParent.parent()
     console.log(logo_data, 'logodata');
     // Form data JS Object
     var formData = new FormData();
     formData.append( '_token', $('meta[name="csrf-token"]').attr('content'));
     formData.append('name', $('#add_comp_form th input[name="name"]').val());
     formData.append('email', $('#add_comp_form td input[name="email"]').val());
     formData.append('website', $('#add_comp_form td input[name="website"]').val());
     formData.append('logo', logo_data);
     // Call function for redirect ajax page

     var my_this = this;

     $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
     });

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
   $(document).on('click', '#update_company', function(e){

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

        $('tr[company-id="'+ id +'"]').html(results);
        console.log('edit ajax company', results);
      },
      error: function(err){
        console.log(err);
      }
    });
  }

  // Function update Company ajax call

  function updateCompany(target_id, page){

    var formUpdate = new FormData();

    // Verifico se c'è stato upload file immagine
    if ($('#update_logo').length > 0) {

      var logo_data = $('#update_logo').get()[0].files[0];
      formUpdate.append('logo', logo_data);
      console.log('logo', logo_data);
    }

    formUpdate.append( '_token', $('meta[name="csrf-token"]').attr('content'));
    formUpdate.append('name', $('th[company-id="'+ target_id +'"] input[name="name"]').val());
    formUpdate.append('email', $('tr[company-id="'+ target_id +'"] input[name="email"]').val());
    formUpdate.append('website', $('tr[company-id="'+ target_id +'"] input[name="website"]').val());

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({

      url: '/company/update/' + target_id,
      type: "POST",
      contentType: false,
      processData: false,
      dataType: "JSON",
      data: formUpdate,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },

      config: {
         headers: {
             'Content-Type': 'multipart/form-data'
         }
      },

      success: function(results){

        // getCompanies(page);
        refreshTr(target_id);
        console.log("updatecompany",results);
      },
      error: function(err){

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
        "_token": $('meta[name="csrf-token"]').attr('content'),
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

  function updateLogo(id, e){

      var token = $('meta[name="csrf-token"]').attr('content');

      var logo_file = $('#update_logo').get()[0].files[0];
      // Form data JS Object
      var formData = new FormData();
      formData.append( '_token', $('meta[name="csrf-token"]').attr('content'));
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
          // $('.card_companies').html(data);
          // e.preventDefault();
          refreshTr(id);
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

  // Function to lieve search results
  function liveSearchCompany(mypage){

    var liveQuery = $('#search_company').val();
    // console.log(liveQuery);
    $('#search_comp_mess').hide();

    console.log('live search');
    $.ajax({

      url: '/search/company',
      data: { query : liveQuery, page:  mypage},
      // dataType: "JSON",
      success: function(results){

          console.log('live search success', results);
        // Controllo presenza messsaggi
        var message = results.message;
        if (message) {
          $('#search_comp_mess').fadeIn(1000);
          $('#search_comp_mess li').text(message);
          console.log('live search', results, results.message, $('.tbody_companies'));
        }

        // Insert rendering page
        $('.card_companies').html(results.html);
      },
      error: function(err){

        console.log(err);
      }
    });
  }

  // function refresh after apdate
  function refreshTr(myId){

    $.ajax({

      url: '/refresh/company/' + myId,
      dataType: "JSON",
      success: function(results){

        // Insert rendering page
        $('tr[company-id="' + myId +'"]').html(results);
        console.log('refresh');
        console.log('refrssch',$('.t_row_emp[data-id="' + myId +'"]'), results );
      },
      error: function(err){

        console.log(err);
      }
    });
  }
