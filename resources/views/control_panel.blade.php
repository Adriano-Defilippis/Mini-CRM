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
        @include('components.page_companies')

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
        @include('components.page_employee')

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

   // variabile checked button
   var checked = false;

   // Azione click Add new COMPANY, mostra form
   $(document).on('click', '#add_comp_btn', function(e){

     checked =! checked;
     // Pulizia div form create company
     $('#add_comp_form').remove();
     console.log(checked);
     // if button is checked
     if (checked) {
       $.ajax({

         url: '/createcompany',
         success: function(data){

           $('.tbody_companies').prepend(data);

           console.log(data);
         },
         error: function(err){

         }
       });
     }

   });
 }

</script>


@endsection
