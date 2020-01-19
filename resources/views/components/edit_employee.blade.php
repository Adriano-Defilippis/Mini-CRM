<th>
  <input type="text" name="first_name" value="{{$employee -> first_name}}">
</th>
<td>
  <input type="text" name="last_name" value="{{$employee-> last_name}}">
</td>
<td>
  <select class="company_select" name="company">
    @foreach ($companies as $company)
      <option value="{{$company -> id}}">{{$company -> name}}</option>
    @endforeach
  </select>
</td>
<td>
  <input type="email" name="email"value="{{$employee-> email}}">
</td>
<td>
  <input type="phone" name="phone"value="{{$employee-> phone}}">
</td>
<td>
  <button id="update_employee" data-id="{{$employee-> id}}" type="button" class="btn btn-light">edit</button>

  <button class="back_btn_emp" type="button" name="button">Back</button>
</td>
