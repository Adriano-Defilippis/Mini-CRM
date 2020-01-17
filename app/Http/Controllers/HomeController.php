<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Company;

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

        // $companies = Company::all()->take(10);
        // $employees = Employee::all()->take(10);

        $count_companies = Company::count();
        $count_employees = Employee::count();
        return view('control_panel', compact('count_companies', 'count_employees'));
        // return view('control_panel', compact('companies', 'employees','count_companies', 'count_employees'));
    }
}
