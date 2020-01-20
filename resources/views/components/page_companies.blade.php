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
