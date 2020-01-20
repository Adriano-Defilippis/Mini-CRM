<th employee-id="{{$employee-> id}}">
  <input type="text" name="first_name" value="{{$employee -> first_name}}">
</th>
<td employee-id="{{$employee-> id}}">
  <input type="text" name="last_name" value="{{$employee-> last_name}}">
</td>
<td>
  <select employee-id="{{$employee-> id}}" class="company_select" name="company">
    @foreach ($companies as $company)
      <option value="{{$company -> id}}"

          @if ($company -> id == $employee -> company -> id)
            selected
          @endif
        >
        {{$company -> name}}</option>
    @endforeach
  </select>
</td>
<td>
  <input employee-id="{{$employee-> id}}" type="email" name="email"value="{{$employee-> email}}">
</td>
<td>
  <input employee-id="{{$employee-> id}}" type="phone" name="phone"value="{{$employee-> phone}}">
</td>
<td>
  <button id="update_employee" data-id="{{$employee-> id}}" type="button" class="btn btn-light">edit</button>

  <button class="back_btn_emp" type="button" name="button">Back</button>
</td>
