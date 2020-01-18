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
      <div class="card_employees card-body">

        {{-- TAble for Employee result, Ajax Call --}}

      </div>


    </div>

  </div>
</div>




@endsection
