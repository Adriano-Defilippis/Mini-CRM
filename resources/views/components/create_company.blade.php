
<tr id="add_comp_form">
  <th>
    <input type="text" name="name" placeholder="Insert name of a Company" value="">
    {{-- TODO inserire messaggi di errore validazione campi --}}
    {{$counter_employees}}
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

<script type="text/javascript">


  $(document).ready(init);

  function init(){

    $(document).on('click', '#create_comp_btn', function(e){

      var logo_data = $('#logo_file').get()[0].files[0];
      console.log(logo_data, 'logodata');
      // Form data JS Object
      var formData = new FormData();
      formData.append( '_token', "{{ csrf_token() }}");
      formData.append('name', $('input[name="name"]').val());
      formData.append('email', $('input[name="email"]').val());
      formData.append('website', $('input[name="website"]').val());
      formData.append('logo', logo_data);
      // Call function for redirect ajax page

      var my_this = this;



      console.log('form data', formData);

      // Ajax call to send request to validation on back end
      $.ajax({

        url: '/storecompany',
        type: "POST",
        contentType: false,
        processData: false,
        data: formData,
        success: function(data){

          // Remove form after succes
          $('#add_comp_form').html(

              "New Company Added!"
          );

          // Message succes
          setTimeout(function(){

            $('#add_comp_form').remove();
            // Call function for redirect ajax page
            console.log(page);
          }, 2000);



          console.log("data store company ");
        },

        error: function(error){
          console.log("error",error);
        }
      });

    });
  }


</script>
