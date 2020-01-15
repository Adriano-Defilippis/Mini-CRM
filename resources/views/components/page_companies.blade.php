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
        <th>
          <a href="{{route('show.company', $company-> id)}}">
            {{$company -> name}}
          </a>
        </th>
        <td>{{$company -> email}}</td>
        <td class="container_logo">
          <img class="logo" src="storage/{{$company -> logo}}" alt="{{$company -> logo}}">
          <span class="logo_btn" data-id={{$company -> id}}>modifica</span>
        </td>
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
    // Azione click su navigazione pagina
    $(document).on('click','.nav_companies', function(e){

      // remove color placeholder
      $('.nav_companies').css('color', '');
      var page = $(this).data('page');
      // add color placeholder
      $(this).css('color', 'red');


      // Chiamata ajax per i risultati successivi
      getCompanies(page);

    });

    // Azione su click modifica immagine
    $(document).on('click','.logo_btn', function(e){


      // Chiamata ajax form immagine

      var id = $(this).data('id');
      var append = $(this).parent();
      getFormImg(id, append);

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
        $('.card_companies').html(data);

        console.log("log di data ",data);
      },

      error: function(error){
        console.log("error",error);
      }
    });

  }

  // Function for form image ajax
  function getFormImg(id, append){

    $.ajax({

      url: '/form/' + id,
      success: function(data){

        // Insert rendering page
        append.html(data);

        console.log("log di data ",data);
      },

      error: function(error){
        console.log("error",error);
      }
    });

  }
</script>
