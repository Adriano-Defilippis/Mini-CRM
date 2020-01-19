
<tr id="add_comp_form" company-id="{{$counter_employees}}">
  <th>
    <input type="text" name="name" placeholder="Insert name of a Company" value="">
    {{-- TODO inserire messaggi di errore validazione campi --}}

  </th>
  <td>
    <input type="text" name="email" placeholder="Insert Comapany Email" value="">
  </td>
  <td class="container_logo">
    <input id="logo_file" type="file" name="logo" placeholder="Select file image" value="">
  </td>
  <td>
    <input type="url" name="website" placeholder="Insert url Website" value="">
  </td>
  <td>
    <button id="create_comp_btn" type="button" class="btn btn-light">Create</button>
  </td>
</tr>

<script id="create_comp_script" type="text/javascript">



</script>
