<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
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
      $max = $page * 10;
      $min = $max - 9;

      $companies = Company::whereBetween('id', [$min, $max])->get();

      $list = [];



      $html = view('components.page_companies', compact('companies'))
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
    public function store(CompanyRequest $request)
    {

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

        $page = 1;
        // return response()->json($validatedCompany);
        return redirect('/companies')->with('page', $page);

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
