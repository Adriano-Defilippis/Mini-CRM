<form class="action" action="{{route('prova.update', $company -> id)}}" method="post">
  {{ csrf_field() }}
  {{-- <th> --}}
    <label for="name">name</label>
    <input type="text" name="name" value="{{$company -> name}}">

  {{-- </th> --}}
  {{-- <td> --}}
    <label for="email">email</label>
    <input type="text" name="email" value="{{$company-> email}}">
  {{-- </td> --}}
  {{-- <td class="container_logo"> --}}
    {{-- <img class="logo" src="storage/{{$company -> logo}}" alt="{{$company -> logo}}">
    <span class="logo_btn" data-id={{$company -> id}}>modifica</span> --}}
  {{-- </td> --}}
  {{-- <td> --}}
  <label for="website">website</label>
    <input type="text" name="website"value="{{$company-> website}}">
  {{-- </td> --}}
  {{-- <td> --}}
    <button id="update_company" data-id="{{$company-> id}}" type="button" class="btn btn-light">edit</button>
    <button class="back_btn" type="button" name="button">Back</button>
    <button type="submit" name="subupdate" value="prova update">
  {{-- </td> --}}

</form>
