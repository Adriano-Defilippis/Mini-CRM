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
    public function liveSearch(Request $request)
    {
      $list = [];
      $page = $request ->get('page');
      $list[] = $request -> get('query');

      if ($request -> ajax()) {

        $query = $request -> get('query');

        if ($query != '') {

          $companies = Company::where('name', 'like', '%'. $query . '%')
                            ->orWhere('name', 'like', '%'. $query . '%')
                            ->orWhere('name', 'like', '%'. $query . '%')
                            ->orderBy('created_at')
                            ->get();

        } else {

          $companies = Company::orderBy('created_at')
                        ->paginate(10);
        }

        // Conteggio dei risultati
        $count_companies = $companies -> count();

        // Gestione output dopo la ricerca
        if ($count_companies > 0) {


          $html = view('components.page_companies', compact('companies', 'count_companies', 'page'))
                ->render();

          $list[]= $html;
          $list[]= ['companies' => $companies];


          return response()->json($html);

        } else {

          $message = '
            <td>
              No results for search
            </td>

          ';
          return response()->json($message);
        }


      }


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
        //
        // $html = view('components.edit_company', compact('company'))
        //     ->render();
        // // return a JSON array of the companies list
        // return response()->json($html);

        return view('components.edit_company', compact('company'));
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
