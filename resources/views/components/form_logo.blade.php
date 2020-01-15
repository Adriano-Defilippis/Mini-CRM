<form action="{{route('example.upload', $company -> id)}}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}

	<input type="file" name="logo">
	<input data-id="{{$company -> id}}" type="submit" value="go">

</form>

<script type="text/javascript">

  $(document).on('click', 'input[type="submit"]', function(e){


    var id = $(this).data('id');
    console.log('click', $(this), id);
    $.ajax({

      url: '/upload/' + id,
      success: function(data){

        console.log("data", data);
        e.preventDefault();
      },

      error: function(err){

        console.log(err, 'error');
      }
    });
  });

</script>
