<table class="table table-borderless">
  @php
    use App\Company;
  @endphp
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
  <tbody class="employee_tbody">
    @foreach ($employees as $employee)

    <tr class="t_row_emp" employee-id="{{$employee -> id}}">
      @include('components.table_row_employee')
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
     <span class="nav_employees"  data-page="{{$counter_employees}}">  {{ $counter_employees++ }}  </span>
  @endfor
</p>
