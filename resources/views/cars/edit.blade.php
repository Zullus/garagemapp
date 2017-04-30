@extends('layouts.padrao')

@section('content')

	@if($success != '')

		<div class="row alert alert-success">

		  <strong>Sucesso! </strong> {{$success}}

		</div>

	@endif

	{!! Form::open(['url' => route('cars.update', ['id' => $car->id]), 'class' => 'category-form']) !!}

	{!! Form::hidden('id', $car->id) !!}

	<table class="table">

		<thead>
			<tr>
				<th colspan="2">

					Alterar dados do veículo {{$car->brand . ' ' . $car->model . ' ' . $car->color . ' ' . $car->plate}} pertecente à {{$car->owner['name']}}

				</th>
			</tr>
		</thead>

		<tbody>

			<tr>
				<td><strong>Marca:</strong></td>
				<td>
					{!! Form::text('brand', $car->brand, ['class' => 'form-control select2', 'placeholder' => 'Marca do carro']) !!}
				</td>
			</tr>

			<tr>
				<td><strong>Modelo:</strong></td>
				<td>
					{!! Form::text('model', $car->model, ['class' => 'form-control select2', 'placeholder' => 'Marca do carro']) !!}
				</td>
			</tr>

			<tr>
				<td><strong>Cor:</strong></td>
				<td>
					{!! Form::text('color', $car->color, ['class' => 'form-control select2', 'placeholder' => 'Marca do carro']) !!}
				</td>
			</tr>

			<tr>
				<td><strong>Placa:</strong></td>
				<td>
					{!! Form::text('plate', $car->plate, ['class' => 'form-control select2', 'placeholder' => 'Marca do carro']) !!}
				</td>
			</tr>

		</tbody>

	</table>

	<button class="btn btn-warning">Enviar</button>

	{!! Form::close() !!}

	<br><br>

	<a href="javascript:history.go(-1);">
		<button class="btn btn-success">Voltar</button>
	</a>

@endsection