<?php

namespace App\Http\Controllers;

use App\Children;
use App\People;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use DB;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return People::all();
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

        $validator = Validator::make(
        	$request->all(),
			[
				'first_name' => ['required', 'min:1', 'regex:/[А-Яа-яЁё]/u'],
				'second_name'=> ['required', 'min:1', 'regex:/[А-Яа-яЁё]/u'],
				'surname'=> ['required', 'min:1', 'regex:/[А-Яа-яЁё]/u'],
				'email'=> ['required', 'unique:people'],
				'birthday'=> ['required','date'],
				'mark'=> ['required',  'max:255'],
				'model'=> ['required', 'max:255'],
			]
		);

        if($validator->fails()){

        	return [
        		"status" => false,
        		"errors" => $validator->messages()
			];
		}

		$people = People::create([
			'first_name' => $request->first_name,
			'second_name'=> $request->second_name,
			'surname'=> $request->surname,
			'email'=> $request->email,
			'birthday'=> Carbon::parse($request->birthday)->format('Y-m-d H:i:s'),
			'mark'=> $request->mark,
			'mark'=> $request->mark,
			'model'=> $request->model,
			'auto'=> $request->auto,
		]);


        if($people->id){

        	foreach ($request->children as $child){
				$childValidator = Validator::make(
					$child,
					[
						'first_name' => ['required', 'min:1', 'regex:/[А-Яа-яЁё]/u'],
						'second_name'=> ['required', 'min:1', 'regex:/[А-Яа-яЁё]/u'],
						'surname'=> ['required', 'min:1', 'regex:/[А-Яа-яЁё]/u'],
						'email'=> ['required', 'unique:childrens'],
						'birthday'=> ['required','date'],
					]
				);

				if(!$childValidator->fails()){

					Children::create([
						'first_name' => $child['first_name'],
						'parent_id' => $people->id,
						'second_name'=> $child['second_name'],
						'surname'=> $child['surname'],
						'email'=> $child['email'],
						'birthday'=> Carbon::parse($child['birthday'])->format('Y-m-d H:i:s'),
					]);
				}
			}

		}


		return [
			"status" => true,
			"people" => $people
		];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		if(!intval($id)) return [];

    	$people = People::find($id);

    	if(!$people) {
			return response()->json([
				"status" => false,
				"message" => "Element not found"
			])->setStatusCode(404);
		}

		$childrens = DB::table('childrens')->where('parent_id', $id)->get();

    	$people['children'] = $childrens;

		return $people;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

	public function checkMail($id)
	{
		//
	}
}
