{{-- <table class="table table_companies table-borderless">
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
      <tr class="t_row" company-id="{{$company -> id}}">
        <th>
          <a href="{{route('show.company', $company-> id)}}">
            {{$company -> name}}
          </a>
        </th>
        <td>{{$company -> email}}</td>
        <td data-page="" class="container_logo">
          <img class="logo" src="storage/{{$company -> logo}}" alt="">
          <span class="logo_btn" data-page="s" data-id={{$company -> id}}>modifica</span>
        </td>
        <td>{{$company -> website}}{{$count_companies}}</td>
        <td>
          <button type="button" class="btn_edit_comp btn btn-light" data-id="{{$company -> id}}">Edit</button>
          <button type="button" class="btn_delete_comp btn btn-danger" data-id="{{$company -> id}}">Delete</button>

        </td>
      </tr>
    @endforeach
  </tbody>
</table>

{{-- Navigatore risultati --}}
<p>
  @php
    $counter_result = 1;
  @endphp
  @for ($i=1; $i <= $count_companies; $i+= 10)
     <span class="nav_companies" data-type="search_comp_paginate" data-page="{{$counter_result}}"> {{ $counter_result++ }} </span>
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
</script> --}}
