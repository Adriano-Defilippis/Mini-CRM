<table class="table table-borderless">
  @php
    use App\Company;
    $companies = Company::all();
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

    @if ($route == 'show.company' || $route == 'show_more_related_employees')
      {{-- Form create employee --}}
      <th employee-id="">
        <input type="text" name="first_name" value=" ">
      </th>
      <td employee-id=" ">
        <input type="text" name="last_name" value=" ">
      </td>
      <td>
        {{$company -> name}}
      <td>
        <input employee-id="" type="email" name="email"value="">
      </td>
      <td>
        <input employee-id="" type="phone" name="phone"value="">
      </td>
      <td>
        <button id="storage_employee" data-id="{{$company -> id}}}" type="button" class="btn btn-light">Storage</button>
      </td>
    @endif

  </th>

    @foreach ($employees as $employee)


      {{-- @include('components.table_row_employee') --}}
      <tr class="t_row_emp" employee-id="{{$employee -> id}}">
        <th>{{$employee -> first_name}}</th>
        <td>{{$employee -> last_name}}</td>
        <td>
          <a href="{{route('show.company', $employee -> company -> id)}}">
            {{$employee -> company -> name}}
          </a>
        </td>
        <td>{{$employee -> email}}</td>
        <td>{{$employee -> phone}}</td>
        <td>
          <button data-id="{{$employee -> id}}" type="button" class="btn_edit_empl btn btn-light">Edit</button>
          <button data-id="{{$employee -> id}}" type="button" class="btn_delete_empl btn btn-danger">Delete</button>
        </td>
      </tr>


    @endforeach
  </tbody>
</table>



<p>
  @php
    $counter_employees = 1;
  @endphp
  @for ($i=1; $i <= $count_employees; $i++)
    @if ($route == 'search.employee')

      <span class="nav_employees" data-type="search_emp_page"  data-page="{{$counter_employees}}">  {{ $counter_employees++ }}  </span>


    @elseif ($route == 'show.company' || $route == "show_more_related_employees")

        <span class="nav_related_employees" data-type="show_more_related_emp" data-id="{{$company -> id}}"  data-page="{{$counter_employees}}">  {{ $counter_employees++ }}  </span>
    @else
      <span class="nav_employees" data-type="emp_res" data-type="comp_res" data-page="{{$counter_employees}}"> {{ $counter_employees++ }} </span>

    @endif
@endfor
</p>
