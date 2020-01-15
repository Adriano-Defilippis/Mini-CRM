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
{{-- Navigatore risultati --}}
<p>
  @php
    $counter_employees = 1;
  @endphp
  @for ($i=1; $i <= $count_employees; $i+= 10)
     <span class="nav_employees" data-page="{{$counter_employees}}">  {{ $counter_employees++ }}  </span>
  @endfor
</p>
