@extends('layouts.padrao')

@section('content')

	<h1 title="Carros">Carros</h1>

	<table class="table">

		<thead>
			<tr>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Cor</th>
				<th>Placa</th>
				<th>Proprietário</th>
			</tr>
		</thead>

		<tbody>

			@foreach($cars as $car)

				<tr>
					<td>

						<a href="{!! route('cars.show', ['id' => $car['id']]) !!}">
							{{$car['brand']}}
						</a>

					</td>
					<td>{{$car['model']}}</td>
					<td>{{$car['color']}}</td>
					<td>{{$car['plate']}}</td>
					<td>

						<a href="{!! route('owners.show', ['id' => $car['owner']['id']]) !!}">
							{{$car['owner']['name']}}
						</a>

					</td>
				</tr>

			@endforeach

		</tbody>

	</table>


@endsection