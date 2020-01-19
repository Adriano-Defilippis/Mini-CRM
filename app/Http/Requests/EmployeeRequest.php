<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'first_name' => 'required|string|max:50',
          'last_name' => 'required|string|max:50',
          'company' => 'required|integer',
          'email' => 'nullable|string|max:50',
          'phone' => 'nullable|string|max:50'
        ];
    }

    // Messaggio di ritorno in caso di errore
    public function messages()
   {
       return [
           'first_name.required' => 'First name is required!',
           'last_name.required' => 'Last name is required!'
       ];
   }
}
