@extends('layouts.padrao')

@section('content')

	<div class="row">

		<div class="col-md-12">

			<h1 title="Adicionar Telefone">Adicionar Telefone</h1>

			{!! Form::open(['url' => route('phones.add'), 'class' => 'category-form']) !!}

			{!! Form::hidden('owner_id', $owner) !!}

				<div class="form-group">
	    			<label for="email">Número:</label>
	    			{!! Form::text('phonenumber[]', NULL, ['class' => 'form-control select2', 'placeholder' => 'Numero do Telefone']) !!}
				</div>

				<div class="form-group">
	    			<label for="email">Tipo:</label>
	    			{!! Form::select('phonetype[]', [1 => 'Fixo',2 => 'Celular'], NULL, ['class' => 'form-control select2', 'placeholder' => 'Tipo do Telefone']) !!}
				</div>

				<div class="form-group">
	    			<label for="email">Operadora:</label>
	    			{!! Form::select('phonecompany[]', ['Oi'=>'Oi', 'TIM'=>'TIM', 'Vivo'=>'Vivo', 'Claro'=>'Claro', 'Nextel'=>'Nextel', 'Correiros'=>'Correiros', 'PortoTelecon'=>'PortoTelecon'], NULL, ['class' => 'form-control select2', 'placeholder' => 'Operadora do Telefone']) !!}
				</div>

				<button class="btn btn-warning">Enviar</button>

			{!! Form::close() !!}

		</div>

	</div>

@endsection