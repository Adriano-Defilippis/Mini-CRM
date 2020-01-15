<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \FileUploader;
use App\Company;

class LogoController extends Controller
{

	/**
	 * show the form
   * @param  int  $id
   * @return \Illuminate\Http\Response
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index($id) {

          $html = view('components.form_logo', compact('id'))
              ->render();

      return response()->json([$html]);
		// return view('components.form_logo', compact('id'));
	}

  /**
   * Display the specified resource.
   *

   */
  public function show($id)
  {
      $company = Company::findOrFail($id);
      return view('components.form_logo', compact('company'));
  }

	/**
 * submit the form
 *
 * @return void
 */
public function submit(Request $request, $id) {

  // Search item to upload image
  $company = Company::findOrFail($id);

  // Name for file
  $targetFile = str_replace(" ", "_", $company -> name) . "_" . $company-> id . ".jpg";


  // FileUpload
  $validatedLogo = $request ->validate([
    'logo' => 'required'
  ]);

  $file = $request -> file('logo');

  // Upload file in storage folder
  if ($file) {

      $targetPath = 'storage';

      $file->move($targetPath, $targetFile);
        $validatedLogo['logo']=$targetFile;
    }


  // Upload database logo path
  $company->update($validatedLogo);

  return redirect()->back();


}

/**
 * delete a file
 *
 * @return void
 */
public function removeFile(Request $request) {
  @unlink($_POST['file']);
  exit;
}
}
