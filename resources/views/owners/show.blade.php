@extends('layouts.padrao')

@section('content')

	<table class="table">
		<thead>
			<tr>
				<th colspan="2">
					Dados do Proprietário {{$owner->name}}
				</th>
			</tr>
		</thead>

		<tbody>
			<tr>
				<td>Nome:</td>
				<td>{{$owner->name}}</td>
			</tr>
			<tr>
				<td>Endereço:</td>
				<td>{{$owner->address}}</td>
			</tr>
			<tr>
				<td>Setor de Trabalho no Céu</td>
				<td>{{$owner->sector}}</td>
			</tr>
			<tr>
				<td>Horário que Guarda o Carro:</td>
				<td>{{$owner->timetable}}</td>
			</tr>
			<tr>
				<td>Dia de Pagamento:</td>
				<td>{{$owner->payday}}</td>
			</tr>
			<tr>
				<td>Valor:</td>
				<td>R$ {{number_format($owner->value, 2, ',', '.')}}</td>
			</tr>
			<tr>
				<td>Observação:</td>
				<td>{{$owner->obs}}</td>
			</tr>
			<tr>
				<td colspan="2"><strong>Telefone(s)</strong></td>
			</tr>

			@foreach($phones as $phone)

				<tr>
					<td colspan="2">
						{{$phone->number}}

						@if($phone->type == 2)

							- {{ $phone->company}}

						@endif

					</td>
				</tr>

			@endforeach
			<tr>
				<td colspan="2"><strong>Dados do Carro</strong></td>
			</tr>

			@foreach($cars as $car)

				<tr>
					<td colspan="2">
						{{$car->brand . ' ' . $car->model . ' ' . $car->color . ' ' . $car->plate}}
					</td>
				</tr>

			@endforeach

		</tbody>
	</table>

	<a href="{!! route('owners.edit', ['id' => $owner->id]) !!}">
		<button class="btn btn-primary">Editar</button>
	</a>

	<br><br>

	<a href="{!! route('owners.destroy', ['id' => $owner->id]) !!}">
		<button class="btn btn-danger">Cancelar Cadastro</button>
	</a>

	<br><br>

	<a href="javascript:history.go(-1);">
		<button class="btn btn-success">Voltar</button>
	</a>

@endsection