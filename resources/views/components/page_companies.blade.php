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
{{$route}}
<p>
  <div class="nav_bar_comp">
    @php
      $counter_companies = 1;
    @endphp
    @for ($i=1; $i <= $count_companies; $i++)
    
      @if ($route == 'search.company')

        <span class="nav_companies" data-type="search_comp_res" data-page="{{$counter_companies}}"> {{ $counter_companies++ }} </span>
        {{$route}}
      @else
        <span class="nav_companies" data-type="comp_res" data-page="{{$counter_companies}}"> {{ $counter_companies++ }} </span>
        {{$route}}
      @endif
    @endfor



  </div>

</p>
