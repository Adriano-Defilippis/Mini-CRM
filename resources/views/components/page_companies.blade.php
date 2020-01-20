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
  <tbody class="tbody_companies" id="attach_message">


    @foreach ($companies as $company)
      <tr class="t_row" company-id="{{$company -> id}}">
        @include('components.table_row_company')
      </tr>
    @endforeach
  </tbody>
</table>

{{-- Navigatore risultati --}}
<p>
  @php
    $counter_companies = 1;
  @endphp
  @for ($i=1; $i <= $count_companies; $i+= 10)
     <span class="nav_companies" data-page="{{$counter_companies}}"> {{ $counter_companies++ }} </span>
  @endfor
</p>

<script type="text/javascript">


  $(document).ready(init);

  function init(){

    // Azione su click modifica immagine
    $(document).on('click','.logo_btn', function(e){


      // Chiamata ajax form immagine

      var id = $(this).data('id');
      var append = $(this).parent();
      var page = append.data('page');
      console.log(page);
      getFormImg(id, append, page);

    });


  }



  // Function for form image ajax
  function getFormImg(id, append, page){

    // Form data JS Object
    var myFormData = new FormData();
    myFormData.append( '_token', "{{ csrf_token() }}");
    myFormData.append('page', page);

    $.ajax({

      url: '/form/' + id,
      type: "POST",
      contentType: false,
      processData: false,
      data: myFormData,
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

  // function refresh after apdate
  function refreshTr(myId){

    $.ajax({

      url: '/refresh/company/' + myId,
      // dataType: "JSON",
      success: function(results){

        // Insert rendering page
        $('tr[data-id="' + myId +'"]').html(results);
        console.log('refresh');
        console.log('refrssch',$('.t_row_emp[data-id="' + myId +'"]'), results );
      },
      error: function(err){

        console.log(err);
      }
    });
  }
</script>
