<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     *SHOW NEXT 10 EMPLOYEES
     *RETURN BLADE VIEW WHIT AJAX CALL
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showMore(Request $request)
    {

      // $page = $request -> page;

      // $max = $page * 10;
      // $skip = $max - 10;
      //
      // if ($page == 1) {
      //
      //   $skip = 0;
      // }

      $employees = Employee::orderBy('first_name')
            ->paginate(10);

      // $employees = Employee::skip($skip)->take(10)->get();
      $count_employees = Employee::count();
      $list = [];



      $html = view('components.page_employee', compact('employees', 'count_employees'))
          ->render();

      $list[] = $html;

      // return a JSON array of the companies list
      return response()->json($list);


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
      $employee = Employee::findOrFail($id);
      $companies = Company::orderBy('name')->get();

      $html = view('components.edit_employee', compact('employee', 'companies'))
          ->render();
      // return a JSON array of the companies list
      return response()->json($html);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
      // Retrieve the validated input data...
      $validatedData = $request->validated();
      $employee_to_update = Employee::findOrFail($id);

      $id_str = $request -> company_id;

      $id_company = (int)$id_str;
      //
      $employee_to_update -> company() -> associate($id_company);
      //
      $employee_to_update -> save();
      // $validatedData['company_id'] = $id_company;

      $employee_to_update-> update($validatedData);







      $list = [];
      $list[] = $validatedData;
      // $list[] = (int)$id_company;

      return response()->json($list);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        $employee -> delete();

        return response()->json();
    }
}
