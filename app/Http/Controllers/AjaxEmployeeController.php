<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Company;
use DB;

class AjaxEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Refresh single item row table.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function refreshItem($id)
    {
      $employee = Employee::findOrFail($id);
      $html = view('components.table_row_employee', compact('employee'))->render();
      return response()->json($html);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function liveSearch(Request $request)
    {
      $list = [];
      $page = $request -> get('page');
      $list[] = $request -> get('query');

      if ($request -> ajax()) {

        $query = $request -> get('query');

        if ($query != '') {

          $current_page = $request->get('page');

          $employees = Employee::where('first_name', 'like', '%'. $query . '%')
                                ->orWhere('last_name', 'like', '%'. $query . '%')
                                ->orWhere('email', 'like', '%'. $query . '%')
                                ->orWhere('phone', 'like', '%'. $query . '%')
                                ->orderBy('created_at')
                                ->paginate(10);


          // $employees->page(2);

          $output['current_page'] = $current_page;
          $count_employees = $employees -> lastPage();


          // Gestione output dopo la ricerca
          if ($employees -> total() == 0) {

            $output['message'] =  'No results for search';


          } else {

            $count_employees = $employees -> lastPage();

            // Count copmany result query
            $output['count_emplyees'] = $count_employees;
            $output['employees'] = $employees;
            $route = \Request::route()->getName();

            $output['html'] = view('components.page_employee', compact('employees', 'count_employees', 'route'))
                  ->render();


          }

        }

      }

      return response()->json($output);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
