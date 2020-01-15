@extends('layouts.app')

@section('content')

  <h2>{{$company -> name}}</h2>


  @foreach ($company -> employees as $employee)
    <ul>
      <li>{{$employee-> first_name}}</li>
      <li>{{$employee-> last_name}}</li>
      <li>{{$employee-> email}}</li>
      <li>{{$employee-> phone}}</li>
      <li>{{$employee-> company -> name}}</li>
    </ul>
  @endforeach


@endsection
