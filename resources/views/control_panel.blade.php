@extends('layouts.app')

@section('content')

  {{-- @php
    dd($employees);
  @endphp --}}

  <div class="card">
  <div class="card-header">
    COMPANIES
  </div>
  <div class="card-body">

    <button type="button" class="btn btn-warning">Add Company</button>

    {{-- Tabella companies --}}
    <div class="card">
      <div class="card-header">
        Companies list
      </div>
      <div class="card-body">

        <table class="table table-borderless">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Logo</th>
              <th scope="col">Website</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody class="tbody_companies">

            @foreach ($companies as $company)
              <tr>
                <th>{{$company -> name}}</th>
                <td>{{$company -> email}}</td>
                <td>{{$company -> logo}}</td>
                <td>{{$company -> website}}</td>
                <td>
                  <button type="button" class="btn btn-light">Edit</button>
                  <button type="button" class="btn btn-danger">Delete</button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
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
</div>

{{-- Card Employees --}}
<div class="card">
<div class="card-header">
  EMPLOYEE
</div>
<div class="card-body">

  <button type="button" class="btn btn-warning">New Employee</button>

  {{-- Tabella Employee --}}
  <div class="card">
    <div class="card-header">
      Companies list
    </div>
    <div class="card-body">

      <table class="table table-borderless">
        <thead>
          <tr>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Company</th>
            <th scope="col">email</th>
            <th scope="col">Phone</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($employees as $employee)

            <tr>
              <th>{{$employee -> first_name}}</th>
              <td>{{$employee -> last_name}}</td>
              <td>{{$employee -> company-> name}}</td>
              <td>{{$employee -> email}}</td>
              <td>{{$employee -> phone}}</td>
              <td>
                <button type="button" class="btn btn-light">Edit</button>
                <button type="button" class="btn btn-danger">Delete</button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
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
</div>

<script type="text/javascript">


  $(document).ready(init);

  function init(){

    console.log('holaaaa');

    $(document).on('click','.nav_companies', function(){

      var page = $(this).data('page');
      console.log('click', page);

      // Chiamata ajax per i risultati successivi
      getData(page);
    });
  }

  function getData(page){

    $.ajax({

      url: '/companies',
      data: {
        'page': page
      },
      success: function(data){

        $('.tbody_companies').append(data);
        console.log(data);
      },

      error: function(error){
        console.log(error);
      }
    });

  }

</script>

@endsection
