<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
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
    public function create(Request $request)
    {
      $list = [];

      $counter_employees = $request -> page;

      $html = view('components.create_company', compact('counter_employees'))
          ->render();


      // return a JSON whit html
      return response()->json($html);
    }


    /**
     *SHOW NEXT 10 COMPANIES
     *RETURN BLADE VIEW WHIT AJAX CALL
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showMore(Request $request)
    {

      $page = $request -> get('page');


      $companies = Company::orderBy('created_at')
            ->paginate(10);

      // $companies = Company::skip($skip)->take(10)->get();
      $count_companies = $companies -> lastPage();

      $list = [];

      $route = \Request::route()->getName();

      $html = view('components.page_companies', compact('companies', 'count_companies', 'page', 'route'))
          ->render();

      $list[] = $html;

      // return a JSON array of the companies list
      return response()->json($html);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {

      $validatedCompany = $request -> validated();


      $file = $request -> file('logo');

      // Upload file in storage folder
      if ($file) {


        // Name for file
        $targetFile = str_replace(" ", "_", $validatedCompany['name'])
                        . "-"
                        . $id
                        .	"-"
                        . str_replace(" ", "_", now())
                        . $file->getClientOriginalExtension();

          $targetPath = 'storage';

          $file->move($targetPath, $targetFile);
          // Assegno url con nome file da salvare nel database
          $validatedCompany['logo']=$targetFile;
        }




        $new_company = Company::create($validatedCompany);

        $last_page = Company::count();
        // $page = $count_companies % 10;
        //
        $list = [];
        $list[] = $validatedCompany;
        $list[] = $last_page;


        return response()->json($list);

    }

    /**
     * Function to refresh last results
     *
     */

     public function lastResult(){

       $count_companies = Company::count();

       $skip = $count_companies % 10;
       $take = $count_companies - $skip;

       $companies = Company::skip($skip)->take($take)->get();

       $list = [];

       $html = view('components.page_companies', compact('companies', 'count_companies'))
           ->render();

       $list[] = $html;

       // return a JSON array of the companies list
       return response()->json($list);
     }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
      {
          $company = Company::findOrFail($id);
          
          // Related Employee of this Copany Id
          $employees = Employee::where('company_id', $id)->paginate(10);
          $count_employees = $employees -> lastPage();
          $route = \Request::route()->getName();



           $html = view('page.company_blade_show', compact('company', 'employees', 'count_employees', 'route'));


           if ($route == 'show_more_related_employees') {

             $html = view('components.page_employee', compact('employees', 'count_employees', 'route'));
           }

          return $html;

          //BACK PER VUE
          // $company = Company::findOrFail($id);
          // // Related Employee of this Copany Id
          // $employees = Employee::where('company_id', $id)->paginate(10);
          // $count_employees = $employees -> total();
          // $route = \Request::route()->getName();
          //
          // $results = [];
          // $results['company'] = $company;
          // $results['employees'] = $employees;
          // $results['count_employees'] = $count_employees;
          // $results['html'] = view('page.company_vue_show', compact('company', 'employees', 'count_employees'));
          //
          // return view('page.company_vue_show', compact('company', 'employees', 'count_employees'));

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
    public function update(CompanyRequest $request, $id)
    {

      $validatedCompany = $request -> validated();
      $company_to_update = Company::findOrFail($id);


      $file = $request -> file('logo');

      if ($file) {

        // Name for file
    		$targetFile = str_replace(" ", "_", $company_to_update -> name)
    										. "-"
    										. $id
    										.	"-"
    										. str_replace(" ", "_", now())
    										. $file->getClientOriginalExtension();

        \File::delete( public_path('storage/') . $company_to_update -> logo );

        // Name for file
        $targetFile = $company_to_update -> logo;
        $list[] = $request -> logo;

        $targetPath = 'storage';

        $file->move($targetPath, $targetFile);
        // Assegno url con nome file da salvare nel database
        $validatedCompany['logo']=$targetFile;
      }


      $company_to_update->update($validatedCompany);

      $list = [];

      $list[] = $validatedCompany;
      $list[] = $company_to_update;
      $list['public_path'] = public_path('storage/') . $company_to_update -> logo;

      // $list = 'ciao';
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
      $company = Company::findOrFail($id);

      $employees = $company -> employees;


      if ($employees) {
        $employees->each(function($employee){

          $employee -> delete();
        });
      }

      // Delete image file logo
      \File::delete( public_path('storage/') . $company -> logo );

      $company-> delete();

      return response()->json();

    }
}
