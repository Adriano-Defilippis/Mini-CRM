@php
  use App\Company;
@endphp

<th>{{$employee -> first_name}}</th>
<td>{{$employee -> last_name}}</td>
<td>
  <a href="{{route('show.company', $employee -> company -> id)}}">
    {{$employee -> company -> name}}
  </a>
</td>
<td>{{$employee -> email}}</td>
<td>{{$employee -> phone}}</td>
<td>
  <button data-id="{{$employee -> id}}" type="button" class="btn_edit_empl btn btn-light">Edit</button>
  <button data-id="{{$employee -> id}}" type="button" class="btn_delete_empl btn btn-danger">Delete</button>
</td>
