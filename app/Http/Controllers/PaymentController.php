<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\OwnerController as Owner;
use Illuminate\Support\Facades\DB;
//use App\Garagem\DateFormat as DateFormat;

class PaymentController extends Controller
{
	protected $dateFormat;

	public function __construct(){

		//$this->dateFormat = \App::make('App\Garagem\DateFormat');

	}

	public function index($month = null, $year = null){

		$months = array(1 => 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');

		if(is_null($month)){

			$month = date('n');
		}

		if(is_null($year)){

			$year = date('Y');
		}

		$day = date('d');

		$payments = \App\Payment::with('owner')
					->whereBetween('payment_date', [$year . '-' . $month . '-1', $year . '-' . $month . '-31'])
					->paginate(env('PAGINATION_ITEMS', 20));

		$total = '';

		foreach ($payments as $p) {

			$total += $p->amount;

			$p->payment_date = $this->manipulaData($p->payment_date, 0);

		}

		$allowners = $this->allowners();

		return view('payments.index')->with(compact('payments', 'total', 'allowners', 'day', 'month', 'year', 'months'));

	}

	public function show($id){

		$payment = $this->find($id);

		$sucesso = '';

    	return view('payments.show')->with(compact('payment', 'sucesso'));

	}

	public function store(Request $request){

		$input = $request->all();

		$input['amount'] = str_replace('.', '', $input['amount']);

		$input['amount'] = str_replace(',', '.', $input['amount']);

		$payment_date = $input['year'] . '-' . $input['month'] . '-' . $input['day'];

		$payment = new \App\Payment;

		//$payment->fill($request);
		$payment->amount   	   = (float)$input['amount'];
        $payment->owner_id 	   = $input['owner_id'];
        $payment->payment_date = $payment_date;//date('Y-n-d');

    	$payment->save();

    	return $this->index();

	}

	public function update($id, $request){

		$payment = $this->find($id);

		$car->fill($request);

    	$car->save();

    	return true;

	}

	public function find($id){

		$payment = \App\Payment::find($id);

		return $payment;

	}

	public function findDate(Request $request){

		$input = $request->all();

		return $this->index($input['month'], $input['year']);
	}

	public function latePayment($month = ''){

		if($month == ''){
			$month = date('m');
		}

		$day = date('d');

		$owners = DB::select("SELECT * FROM owners WHERE id NOT IN ( SELECT owner_id FROM payments WHERE payment_date < NOW() and MONTH(payment_date) = $month ) AND payday < $day AND deleted_at is null");

		if(count($owners) == 0){

			return null;

		}

		return $owners;

	}

	private function manipulaData($data, $h){

		/*
		Retorna a data em formato dd/mm/aaaa ou dd/mm/aaaa hh:mm:ss
		$data -> Data em formato MySQL que será convertida
		$h -> Formato desejado
			0: Não exibe a hora
			1: Exibe a hora
		*/

		$rest  = substr ($data, 0, 4);
		$rest1 = substr ($data, 5, 2);
		$rest2 = substr ($data, 8, 2);
		$rest3 = substr ($data, 11, 2);
		$rest4 = substr ($data, 14, 2);
		$rest5 = substr ($data, 17, 2);

		$data_ok = $rest2."/".$rest1."/".$rest;

		if($h == 1){
			$data_ok .= " ".$rest3.":".$rest4.":".$rest5;
		}

		return $data_ok;
	}

	private function allowners(){

		$allowners = [];

		$owners = Owner::allOwners();

		foreach ($owners as $value) {
			$allowners[$value->id] = $value->name;
		}

		return $allowners;
	}
}

