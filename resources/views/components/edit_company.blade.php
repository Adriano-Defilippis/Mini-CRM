<th>
  <input type="text" name="name" value="{{$company -> name}}">
  {{-- TODO inserire messaggi di errore validazione campi --}}

</th>
<td>
  <input type="text" name="email" value="{{$company-> email}}">
</td>
<td class="container_logo">
  <img class="logo" src="storage/{{$company -> logo}}" alt="{{$company -> logo}}">
  <span class="logo_btn" data-id={{$company -> id}}>modifica</span>
</td>
<td>
  <input type="url" name="website"value="{{$company-> website}}">
</td>
<td>
  <button id="this_btn" data-id="{{$company-> id}}" type="button" class="btn btn-light">edit</button>
  <button class="back_btn" type="button" name="button">Back</button>
</td>


<script id="" type="text/javascript">


  $(document).ready(init);

  function init(){

    console.log('olaaa init');
  }

</script>
