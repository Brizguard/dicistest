<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\People;
use Validator;

class AjaxController extends Controller {
	public function checkMail(Request $request){

		$validator = Validator::make(
			$request->all(),
			[
				'email'=> ['required', 'unique:'.$request->table]
			]
		);

		return response()->json(array('checkHaveError'=> $validator->fails()), 200);
	}
}