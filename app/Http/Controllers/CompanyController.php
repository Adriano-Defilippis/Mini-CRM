<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\CompanyRequest;

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

      $page = $request -> page;
      //
      // $max = $page * 10;
      // $skip = $max - 10;
      //
      // if ($page == 1) {
      //
      //   $skip = 0;
      // }

      $companies = Company::orderBy('name')
            ->paginate(10);

      // $companies = Company::skip($skip)->take(10)->get();
      $count_companies = Company::count();

      $list = [];

      $html = view('components.page_companies', compact('companies', 'count_companies', 'page'))
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

      $validatedLogo = $request -> validate([
        'logo'
      ]);

      $validatedCompany = [
        'name' => $request-> name,
        'email' => $request-> email,
        'website' => $request-> website
      ];

      $file = $request -> file('logo');

      // Upload file in storage folder
      if ($file) {

        $count_id = Company::count() + 1;
        // Name for file
        $targetFile = str_replace(" ", "_", $request-> name) . "_" . $count_id . ".jpg";

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
    public function show($id)
    {
        $company = Company::findOrFail($id);

        return view('company_show', compact('company'));
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
        $targetFile = str_replace(" ", "_", $validatedCompany['name']) . "_" . $id . ".jpg";
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

      $company-> delete();

      return response()->json();

    }
}
