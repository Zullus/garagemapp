<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function index(){

    	$phones = \App\Phone::with('owner')
    			->orderBy('owner_id')
    			->paginate(env('PAGINATION_ITEMS', 20));

		return view('phones.index')->with(compact('phones'));

    }

	public function store($request){

		$phone = new \App\Phone;

		if(isset($request['number'])){

			$input = $request;

		}
		//$phone->fill($request);
		$phone->number   = $input['number'];
		$phone->type     = $input['type'];
		$phone->company  = $input['company'];
		$phone->owner_id = $input['owner_id'];

    	$phone->save();

    	return true;

	}

	public function update($request){

		if(isset($request['id'])){

			$input = $request;

		}

		$phone = $this->find($input['id']);

		//$phone->fill($request);
		$phone->number   = $input['number'];
		$phone->type     = $input['type'];
		$phone->company  = $input['company'];
		$phone->owner_id = $input['owner_id'];

    	$phone->save();

    	return true;

	}

	public function destroy($id){

		$phone = $this->find($id);

    	$phone->delete();

    	return true;
	}

	public function find($id){

		$phone = \App\Phone::find($id);

		return $phone;
	}

	public function deletePhonesByOwner($owner_id){

		$phones = DB::table('phones')->where('owner_id', '=', $owner_id)->update(['deleted_at' => date("Y-m-d H:i:s")]);

		return true;
	}

}
