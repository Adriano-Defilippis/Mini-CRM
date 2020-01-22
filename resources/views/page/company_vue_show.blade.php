@extends('layouts.app')

@section('content')
  @include('components_vue.employee_tablerow')

  {{-- Box Risultati Employee collegati ad Id Company --}}
  <div  id="employee-vue" class="card_employees card-body">

    <div class="card">
      <div class="card-header">
        Employee list
      </div>

      <input id="search_employee" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <ul id="search_emp_mess" class="list-group list-group-flush">
        <li class="list-group-item"></li>
      </ul>
      CARD EMPLOYEES
      <div class="card_employees card-body">

        <table class="table table-borderless">

            <ul class="results_header_table">
              <li>First name</li>
              <li>Last Name</li>
              <li>Company</li>
              <li>email</li>
              <li>Phone</li>
              <li>Actions</li>
            </ul>

          @foreach ($employees as $employee)
            <tbody class="box">
              <employee
              :id="{{$employee -> id}}"
              :first_name='"{{$employee -> first_name}}"'
              :last_name='"{{$employee -> last_name}}"'
              :company='"{{$employee -> company -> name}}"'
              :email='"{{$employee -> email}}"'
              :phone='"{{$employee -> phone}}"'
              ><employee>
            </tbody>
            @endforeach



        </table>


      </div>


    </div>


  </div>









@endsection
