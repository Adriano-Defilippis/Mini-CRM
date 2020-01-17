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
        {{-- @include('components.page_companies') --}}

      </div>


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

     destroyCompany(id);
     // Richiamo pagina risultati attiva
     getCompanies(page)
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
  function destroyCompany(target_id){
    console.log('click');
    // Form data JS Object
    // var myFormData = new FormData();
    // myFormData.append( '_token', "{{ csrf_token() }}");
    // myFormData.append('id', target_id);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

      url: '/company/delete/' + target_id,
      type: "GET",
      dataType: "JSON",
      data: {
        'id': target_id
      },
      // data: myFormData,
      succes: function(data){

        console.log('success', data);
        console.log('holaaaa', target_id);
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
        $('.card_companies').html(data[0]);

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
