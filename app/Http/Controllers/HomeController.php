<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Company;
use Route;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $companies = Company::orderBy('created_at')
              ->paginate(10);
        $employees = Employee::orderBy('created_at')
              ->paginate(10);

        $route = \Request::route()->getName();

        $count_companies = $companies -> lastPage();
        $count_employees = $employees -> lastPage();
        return view('control_panel', compact('count_companies', 'count_employees', 'companies', 'employees', 'route'));
        // return view('control_panel', compact('companies', 'employees','count_companies', 'count_employees'));
    }
}
