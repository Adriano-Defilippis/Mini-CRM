@extends('layouts.app')

@section('content')

  {{-- Box Risultati Employee collegati ad Id Company --}}
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
