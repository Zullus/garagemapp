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

	public function add(Request $request){

		$phone = new \App\Phone;

		$input = $request->all();

		//$phone->fill($request);
		$phone->number   = $input['phonenumber'][0];
		$phone->type     = $input['phonetype'][0];
		$phone->company  = $input['phonecompany'][0];
		$phone->owner_id = $input['owner_id'];

    	$phone->save();

    	return redirect()->route('owners.show', ['id' => $input['owner_id']])->with('success', 'Telefone Adicionado!');

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

	public function create($owner){

		return view('phones.create')->with(compact('owner'));
	}

	public function destroy($id, $owner){

		$phone = $this->find($id);

    	$phone->delete();

    	return redirect()->route('owners.show', ['id' => $owner])->with('success', 'Telefone Removido!');
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
