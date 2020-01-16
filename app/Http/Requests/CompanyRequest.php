<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
          'name' => 'required|string|max:50',
          'email' => 'required|nullable|email|unique:users',
          'logo' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:4048',
          'website' => 'nullable'
        ];
    }


    // Messaggio di ritorno in caso di errore
    public function messages()
   {
       return [
           'email.required' => 'Email is required!',
           'name.required' => 'Name is required!'
       ];
   }
}
