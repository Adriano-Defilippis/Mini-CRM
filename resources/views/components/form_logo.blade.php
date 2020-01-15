<form action="{{route('example.upload', $company -> id)}}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}

	<input type="file" name="logo">
	<input type="submit">
</form>
