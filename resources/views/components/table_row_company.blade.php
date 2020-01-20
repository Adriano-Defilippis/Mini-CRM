
<th>
  <a href="{{route('show.company', $company-> id)}}">
    {{$company -> name}}
  </a>
</th>
<td>{{$company -> email}}</td>
<td data-page="" class="container_logo">
  <img class="logo" src="storage/{{$company -> logo}}" alt="">
  <span class="logo_btn" data-page="" data-id={{$company -> id}}>modifica</span>
</td>
<td>{{$company -> website}}</td>
<td>
  <button type="button" class="btn_edit_comp btn btn-light" data-id="{{$company -> id}}">Edit</button>
  <button type="button" class="btn_delete_comp btn btn-danger" data-id="{{$company -> id}}">Delete</button>
  <a href="{{route('delete.company', $company -> id)}}">delete</a>
  <a href="{{route('edit.company', $company -> id)}}">edit</a>

</td>
