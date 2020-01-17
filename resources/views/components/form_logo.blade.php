<form id="logoForm" action="" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}

	<input id="update_logo" data-page=""  type="file" name="logo">
	<input class="update_logo_btn" data-id="{{$company -> id}}" type="button" value="go">

</form>

<script type="text/javascript">




</script>
