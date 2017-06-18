<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\PhoneController as PhoneController;
use App\Http\Controllers\CarController as CarController;

class OwnerController extends Controller
{
	protected $PhoneController;
	protected $carController;

	function __construct(
	PhoneController $PhoneController,
	CarController $carController)
	{
		$this->PhoneController = $PhoneController;
		$this->CarController = $carController;
	}

    public function index(){

    	$owners = \App\Owner::with('cars', 'phones')->orderBy('id', 'desc')->paginate(env('PAGINATION_ITEMS', 20));

		return view('owners.index')->with(compact('owners'));

    }

    public function show($id){

    	$owner = $this->find($id);

    	$phones =  $this->getphones($id);

    	$cars = $this->getcars($id);

    	$sucesso = '';

    	return view('owners.show')->with(compact('owner', 'sucesso', 'cars', 'phones'));

    }

	public function store(Request $request){

		$input = $request->all();

		$owner = new \App\Owner;

		//$owner->fill($request);
		$owner->name      = $input['name'];
        $owner->address   = $input['address'];
        $owner->sector    = $input['sector'];
        $owner->payday    = $input['payday'];
        $owner->timetable = $input['timetable'];
        $owner->value     = str_replace(',', '.', str_replace('.', '', $input['value']));
        $owner->obs       = $input['obs'];

    	$owner->save();

    	foreach ($input['phonenumber'] as $p => $phonenumber) {

    		if($input['phonecompany'][$p] == ''){
				$input['phonecompany'][$p] = 0;
			}

    		$phones = array('number'   => $input['phonenumber'][$p],
							'type'     => $input['phonetype'][$p],
							'company'  => $input['phonecompany'][$p],
							'owner_id' => $owner->id
							);

    		$phone = $this->PhoneController->store($phones);
    	}

    	foreach ($input['carbrand'] as $c => $carbrand) {

    		$cars = array('brand'    => $input['carbrand'][$c],
						  'model'    => $input['carmodel'][$c],
						  'color'    => $input['carcolor'][$c],
						  'plate'    => $input['carplate'][$c],
						  'owner_id' => $owner->id
							);

    		$car = $this->CarController->store($cars);
    	}

    	return $this->show($owner->id);

    	//return true;

	}

	public function update(Request $request){

		$input = $request->all();

		$owner = $this->find($input['id']);

		//$owner->fill($request);
		$owner->name      = $input['name'];
        $owner->address   = $input['address'];
        $owner->sector    = $input['sector'];
        $owner->payday    = $input['payday'];
        $owner->timetable = $input['timetable'];
        $owner->value     = str_replace(',', '.', str_replace('.', '', $input['value']));
        $owner->obs       = $input['obs'];

    	$owner->save();

    	foreach ($input['phoneid'] as $p => $phoneid) {

    		if($input['phonecompany'][$p] == ''){
				$input['phonecompany'][$p] = 0;
			}

    		$phones = array('id'       => $input['phoneid'][$p],
							'number'   => $input['phonenumber'][$p],
							'type'     => $input['phonetype'][$p],
							'company'  => $input['phonecompany'][$p],
							'owner_id' => $input['id']
							);

    		$phone = $this->PhoneController->update($phones);
    	}

    	foreach ($input['carid'] as $c => $carid) {

    		$cars = array('id'       => $input['carid'][$c],
						  'brand'    => $input['carbrand'][$c],
						  'model'    => $input['carmodel'][$c],
						  'color'    => $input['carcolor'][$c],
						  'plate'    => $input['carplate'][$c],
						  'owner_id' => $input['id']
							);

    		$car = $this->CarController->update($cars);
    	}

    	return $this->show($input['id']);

    	//return true;

	}

	public function destroy($id){

		$owner = $this->find($id);

    	if ($owner != null) {

        	$owner->delete();

        	$this->PhoneController->deletePhonesByOwner($id);

        	$this->CarController->deleteCarsByOwner($id);

        	return redirect()->route('owners.index')->with(['message'=> 'Successfully deleted!!']);
   		}

    	return redirect()->route('owners.index')->with(['message'=> 'Objeto já foi apagado']);
	}

	public function find($id){

		$owner = \App\Owner::find($id);

		return $owner;
	}

	public function create(){

		$paydays = array();

		for($i = 1; $i <=30; $i++){
			$paydays[$i] = $i;
		}

		$owner = $cars = $phones = $sucesso = NULL;

		return view('owners.edit')->with(compact('owner', 'sucesso', 'cars', 'phones', 'paydays'));;
	}

	public function edit($id){

		$paydays = array();

		for($i = 1; $i <=30; $i++){
			$paydays[$i] = $i;
		}

		$owner = $this->find($id);

    	$phones = $this->getphones($id);

    	$cars = $this->getcars($id);

    	$sucesso = '';

		return view('owners.edit')->with(compact('owner', 'sucesso', 'cars', 'phones', 'paydays'));;
	}

	public static function allOwners(){

		$owners = \App\Owner::all();

		return $owners;
	}

	private function getcars($id){

		$cars = DB::table('cars')
			->where('owner_id', $id)
			->where('deleted_at', NULL)
			->get();

		return $cars;
	}

	private function getphones($id){

		$phones = DB::table('phones')
			->where('owner_id', $id)
			->where('deleted_at', NULL)
			->get();

		return $phones;
	}
}
