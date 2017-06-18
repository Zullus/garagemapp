@extends('layouts.padrao')

@section('content')

	<div class="row">

		<div class="col-md-12">

			<h1 title="Adicionar Carros">Adicionar Carros</h1>

			{!! Form::open(['url' => route('cars.add'), 'class' => 'category-form']) !!}

			{!! Form::hidden('owner_id', $owner) !!}

				<div class="form-group">
	    			<label for="email">Marca:</label>
	    			{!! Form::text('carbrand[]', NULL, ['class' => 'form-control select2', 'placeholder' => 'Marca do Carro']) !!}
				</div>

				<div class="form-group">
	    			<label for="email">Modelo:</label>
	    			{!! Form::text('carmodel[]', NULL, ['class' => 'form-control select2', 'placeholder' => 'Modelo do Carro']) !!}
				</div>

				<div class="form-group">
	    			<label for="email">Cor:</label>
	    			{!! Form::text('carcolor[]', NULL, ['class' => 'form-control select2', 'placeholder' => 'Cor do Carro']) !!}
				</div>

				<div class="form-group">
	    			<label for="email">Placa:</label>
	    			{!! Form::text('carplate[]', NULL, ['class' => 'form-control select2', 'placeholder' => 'Placa do Carro']) !!}
				</div>

				<button class="btn btn-warning">Enviar</button>

			{!! Form::close() !!}

		</div>

	</div>

@endsection