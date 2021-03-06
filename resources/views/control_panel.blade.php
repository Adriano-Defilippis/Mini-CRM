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
      <input id="search_company" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <ul id="search_comp_mess" class="list-group list-group-flush">
        <li class="list-group-item"></li>
      </ul>
      <div class="card_companies card-body">

        {{-- Component for table body results --}}
        @include('components.page_companies')

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

    {{-- SPAZIO TASTI AZIONE --}}

    <div class="card">
      <div class="card-header">
        Employee list
      </div>

      <input id="search_employee" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <ul id="search_emp_mess" class="list-group list-group-flush">
        <li class="list-group-item"></li>
      </ul>
      {{-- CARD EMPLOYEES --}}
      <div class="card_employees card-body">

        @include('components.page_employee')

      </div>


    </div>

  </div>
</div>




@endsection
