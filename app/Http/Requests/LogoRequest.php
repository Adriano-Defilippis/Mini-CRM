<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class LogoRequest extends FormRequest
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
              'logo' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:4048'
        ];
    }

    // Messaggio di ritorno in caso di errore
    public function messages()
   {
       return [
           'logo.required' => 'No item selected',
           'logo.image' => 'Logo must be an image file',
           'logo.mimes' => 'Image format supported: jpeg.jpg,png, giv,svg',
           'logo.max' => 'Max size: 40,48 MB'
       ];
   }
}
