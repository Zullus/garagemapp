@extends('layouts.padrao')

@section('content')

	<h1 title="Proprietários">Proprietários</h1>

	@if($lateOwners != null)

		<div class="alert alert-danger">

			<h2 title="Em atraso">Em atraso</h2>

			<table class="table">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Dia de Pagamento</th>
					</tr>
				</thead>

				<tbody>
					@foreach($lateOwners as $lo)
						<tr>
							<td>{{$lo->name}}</td>
							<td>{{$lo->payday}}</td>
						</tr>
					@endforeach

				</tbody>
			</table>

		</div>

	@endif

	<table class="table">
		<thead>
			<tr>
				<th>Nome</th>
				<th>Carro</th>
				<th>Telefone</th>
				<th>Setor</th>
			</tr>
		</thead>

		<tbody>
			@foreach($owners as $owner)

				<tr scope="row">
					<td>
						<a href="{!! route('owners.show', ['id' => $owner['id']]) !!}">
							{{$owner['name']}}
						</a>
					</td>
					<td>

						@foreach($owner['cars'] as $c)

							<a href="{!! route('cars.show', ['id' => $c['id']]) !!}">

								{{$c['model'] . ' ' . $c['color'] . ' - ' . strtoupper($c['plate'])}}

							</a>

							<br>

						@endforeach

					</td>
					<td>

						@foreach($owner['phones'] as $p)

							{{$p['number']}}

							@if($p['type'] == 1)
								Fixo
							@else
								Celular
								{{$p['company']}}
							@endif

							<br>

						@endforeach

					</td>
					<td>
						{{$owner['sector']}}
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

	{!!$owners->appends(Request::except('page'))->render()!!}

	<br>

	<a href="{!! route('owners.create') !!}">
		<button class="btn btn-primary">Adicionar Proprietário</button>
	</a>

@endsection