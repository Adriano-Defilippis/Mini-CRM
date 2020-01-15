<table class="table table_companies table-borderless">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Logo</th>
      <th scope="col">Website</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody class="tbody_companies">

    @foreach ($companies as $company)
      <tr>
        <th>{{$company -> name}}</th>
        <td>{{$company -> email}}</td>
        <td>{{$company -> logo}}</td>
        <td>{{$company -> website}}</td>
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

    $(document).on('click','.nav_companies', function(){

      // pulizia html
      $('.table_companies').html('');
      var page = $(this).data('page');
      console.log('click', page);

      // Chiamata ajax per i risultati successivi
      getCompanies(page);
    });
  }

  // Funzione per chiamata ajax risultati pagine companies
  function getCompanies(page){

    $.ajax({

      url: '/companies',
      data: {
        'page': page
      },
      success: function(data){

        // Insert rendering page
        $('.table_companies').html(data);

        console.log("log di data ",data);
      },

      error: function(error){
        console.log("error",error);
      }
    });

  }

</script>
