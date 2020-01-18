<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\CompanyRequest;


class AjaxCompanyController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function refreshAfterDelete(Request $request)
    {
        $page = $request -> page;


        $max = $page * 10;
        $skip = $max - 10;

        if ($page == 1) {

          $skip = 0;
        }

        // TODO contare le righe della tabella anziche gli id
        $companies = Company::skip($skip)->take(10)->get();
        $count_companies = Company::count();

        $html = view('components.page_companies', compact('companies', 'count_companies', 'page'))
            ->render();

        // return a JSON array of the companies list
        return response()->json($html);
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

        $company = Company::findOrFail($id);

        $html = view('components.edit_company', compact('company'))
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
    public function update(CompanyRequest $request, $id)
    {

        // Retrieve the validated input data...
        $validatedData = $request->validated();

        $company_to_update = Company::findOrFail($id);

        $company_to_update -> update($validatedData);

        return response()->json();




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
