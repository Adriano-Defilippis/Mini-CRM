<table class="table table-borderless">
  <thead>
    <tr>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Company</th>
      <th scope="col">email</th>
      <th scope="col">Phone</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($employees as $employee)

      <tr>
        <th>{{$employee -> first_name}}</th>
        <td>{{$employee -> last_name}}</td>
        <td>{{$employee -> company-> name}}</td>
        <td>{{$employee -> email}}</td>
        <td>{{$employee -> phone}}</td>
        <td>
          <button type="button" class="btn btn-light">Edit</button>
          <button type="button" class="btn btn-danger">Delete</button>
        </td>
      </tr>
    @endforeach
  </tbody>

</table>

<script type="text/javascript">


  $(document).ready(init);

  function init(){

    console.log('holaaaa');
    // Azione click su navigazione pagina
    $(document).on('click','.nav_employees', function(){

      // remove color placeholder
      $('.nav_employees').css('color', '');
      var page = $(this).data('page');
      // add color placeholder
      $(this).css('color', 'red');


      // Chiamata ajax per i risultati successivi
      getEmployees(page);
    });
  }

  // Funzione per chiamata ajax risultati pagine companies
  function getEmployees(page){

    $.ajax({

      url: '/employees',
      data: {
        'page': page
      },
      success: function(data){

        // Insert rendering page
        $('.card_employees').html(data);

        // console.log("log di data ",data);
      },

      error: function(error){
        console.log("error",error);
      }
    });

  }

</script>
