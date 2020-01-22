@extends('layouts.app')

@section('content')

  {{-- Box Risultati Employee collegati ad Id Company --}}
  <div class="card_employees card-body">


    @include('components.page_employee')



  </div>

@endsection
