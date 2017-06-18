<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(){

    	$cars = \App\Car::with('owner')->paginate(env('PAGINATION_ITEMS', 20));

		return view('cars.index')->with(compact('cars'));

    }

    public function show($id){

    	$car = $this->find($id);

    	$success = '';

    	return view('cars.edit')->with(compact('car', 'success'));

    }

	public function store($request){

		$car = new \App\Car;

		if(isset($request['brand'])){

			$input = $request;

		}

		//$car->fill($request);
		$car->brand    = $input['brand'];
		$car->model    = $input['model'];
		$car->color    = $input['color'];
		$car->owner_id = $input['owner_id'];
		$car->plate    = $input['plate'];

    	$car->save();

    	return true;

	}

	public function add(Request $request){

		$car = new \App\Car;

		$input = $request->all();

		//$car->fill($request);
		$car->brand    = $input['carbrand'][0];
		$car->model    = $input['carmodel'][0];
		$car->color    = $input['carcolor'][0];
		$car->owner_id = $input['owner_id'];
		$car->plate    = $input['carplate'][0];

    	$car->save();

    	return redirect()->route('owners.show', ['id' => 1])->with('success', 'Carro Adicionado!');

	}

	public function update($request){

		if(isset($request['id'])){

			$input = $request;

		}

		$car = $this->find($input['id']);

		//$car->fill($request);
		$car->brand    = $input['brand'];
		$car->model    = $input['model'];
		$car->color    = $input['color'];
		$car->owner_id = $input['owner_id'];
		$car->plate    = $input['plate'];

    	$car->save();

    	return true;

	}

	public function create($owner){

		return view('cars.create')->with(compact('owner'));
	}

	public function destroy($id){

		$car = $this->find($id);

    	$car->delete();

    	return true;
	}

	public function find($id){

		$car = \App\Car::find($id);

		return $car;
	}

	public function deleteCarsByOwner($owner_id){

		$cars = DB::table('cars')->where('owner_id', '=', $owner_id)->update(['deleted_at' => date("Y-m-d H:i:s")]);

		return true;
	}

	public function selfUpdate(Request $request){

		$car = $this->find($request['id']);

		//$car->fill($request);
		$car->brand = $request['brand'];
		$car->model = $request['model'];
		$car->color = $request['color'];
		$car->plate = $request['plate'];

		$car->save();

		$success = 'Carro alterado com sucesso';

		return view('cars.edit')->with(compact('car', 'success'));

	}


}
