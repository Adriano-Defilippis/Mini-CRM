<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \FileUploader;
use App\Company;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\LogoRequest;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{

	/**
	 * show the form
   * @param  int  $id
   * @return \Illuminate\Http\Response
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index(Request $request, $id) {

		$page= $request -> page;

    $html = view('components.form_logo', compact('id', 'page'))
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
public function submit(LogoRequest $request, $id) {


  // Search item to upload image
  $company = Company::findOrFail($id);

  $file = $request -> file('logo');

  // Upload file in storage folder
  if ($file) {

		$validatedLogo = $request -> validated();

		// Name for file
		$targetFile = str_replace(" ", "_", $company -> name)
										. "-"
										. $id
										.	"-"
										. str_replace(" ", "_", now())
										. $file->getClientOriginalExtension();

			\File::delete( public_path('storage/') . $company -> logo );


      $targetPath = 'storage';

      $file->move($targetPath, $targetFile);

			$validatedLogo = [
				'logo' => $targetFile
			];
    }


  // Upload database logo path
  $company->update($validatedLogo);

	$html = [];
	$html[] = $targetFile;
	$html[] = $company;
	// $hmlt['public path'] = \File::public_path();

  return response()->json($html);


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
