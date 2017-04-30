<?php

namespace Garagem\DateFormat;


class DateFormat extends Controller{

	public function manipulaData($data, $h){

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
}