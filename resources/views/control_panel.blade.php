@extends('layouts.app')

@section('content')

{{-- CARD companies --}}
<div class="card">
  <div class="card-header">
    COMPANIES
  </div>
  <div class="card-body">

    <button id="add_comp_btn" type="button" class="btn btn-warning">Add Company</button>

    <div class="card">
      <div class="card-header">
        Companies list
      </div>
      <div class="card_companies card-body">

        {{-- Component for table body results --}}

      </div>

      {{-- Navigatore risultati --}}
      <p>
        @php
          $counter_companies = 1;
        @endphp
        @for ($i=1; $i <= $count_companies; $i+= 10)
           <span class="nav_companies" data-page="{{$counter_companies}}"> {{ $counter_companies++ }} </span>
        @endfor
      </p>


    </div>
  </div>
</div>

{{-- Card Employees --}}
<div class="card">
  <div class="card-header">
    EMPLOYEE
  </div>
  <div class="card-body">

    <button type="button" class="btn btn-warning">New Employee</button>

    <div class="card">
      <div class="card-header">
        Employee list
      </div>
      <div class="card_employees card-body">

        {{-- Component for table body results --}}
        {{-- @include('components.page_employee') --}}

      </div>

      {{-- Navigatore risultati --}}
      <p>
        @php
          $counter_employees = 1;
        @endphp
        @for ($i=1; $i <= $count_employees; $i+= 10)
           <span class="nav_employees" data-page="{{$counter_employees}}">  {{ $counter_employees++ }}  </span>
        @endfor
      </p>
    </div>

  </div>
</div>

<script type="text/javascript">

 $(document).ready(init);

 function init(){
   // Aggiungo colore stile segnaposto prima pagina
   $('.nav_companies').each(function(key, item){

     if ($(this).text() == 1) {

       $(this).css('color', 'red');
     }

     console.log('page', key, item, $(this).text());
   })
   var page = 1;
   // Chiamata ajax per primi 10 risultati
   getCompanies(page);


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

       error: function(error){
         console.log("error",error);
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
     var table_row = $(this);

     editCompany(id_to_edit, table_row);
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

 }

   // Mostra nascondi EditForm Company
  function editCompany(id, table_row){

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

  function updateCompany(id_delete, page){

    var myThis = this;

    $.ajax({

      url: '/company/update/' + id_delete,
      data: {
        "_token": "{{ csrf_token() }}",
          id: id_delete
      },
      success: function(results){

        myThis.getCompanies(page);
        console.log(results);
      },
      error: function(err){
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

  // Funzione Ajax Refresh result after delete
  function refreshDelete(myPage){
    // console.log('refresh delete');
    $.ajax({

      url: '/companyrefresh',
      data: {
        'page': myPage
      },
      success: function(results){

        // Insert rendering page
        $('.card_companies').html(results);

        console.log("log refresh delete ",results);
      },

      error: function(error){
        console.log("error",error);
      }
    });
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

        myThis.refreshDelete(page);
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

          console.log(err, 'error');
        }
      });

  }



</script>


@endsection
