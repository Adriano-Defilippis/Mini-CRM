@extends('layouts.app')

@section('content')

{{-- CARD companies --}}
<div class="card">
  <div class="card-header">
    COMPANIES
  </div>
  <div class="card-body">

    <button type="button" class="btn btn-warning">Add Company</button>

    <div class="card">
      <div class="card-header">
        Companies list
      </div>
      <div class="card_companies card-body">

              {{-- Component for table body results --}}
              @include('components.page_companies')


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

    <div class="card">
      <div class="card-header">
        Employee list
      </div>
      <div class="card_employee card-body">

        {{-- Component for table body results --}}
        @include('components.page_employee')

      </div>
    </div>

  </div>
</div>



@endsection
