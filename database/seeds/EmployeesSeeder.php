<?php

use Illuminate\Database\Seeder;
use App\Employee;
use App\Company;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Employee::class, 50)->make()

          ->each(function($employee){

            $company = Company::inRandomOrder()->first();

            $employee->company() -> associate($company);

            $employee -> save();

          });
    }
}
