@extends('layouts.padrao')

@section('content')

	@if(!$owner == null)

		{!! Form::open(['url' => route('owners.update', ['id' => $owner->id]), 'class' => 'category-form']) !!}

		{!! Form::hidden('id', $owner->id) !!}

	@else

		{!! Form::open(['url' => route('owners.store'), 'class' => 'category-form']) !!}

	@endif

		<table class="table">
			<thead>
				<tr>
					<th colspan="2">

						@if(!$owner == null)

							Alterar dados de {{$owner->name}}

						@else

							Inserir no proprietário

						@endif
					</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td><strong>Nome:</strong></td>
					<td>
						{!! Form::text('name', !is_null($owner) ? $owner->name : "", ['class' => 'form-control select2', 'placeholder' => 'Nome do proprietário']) !!}
					</td>
				</tr>
				<tr>
					<td><strong>Endereço:</strong></td>
					<td>
						{!! Form::text('address', !is_null($owner) ? $owner->address : "", ['class' => 'form-control select2', 'placeholder' => 'Endereço proprietário, se for vizinho']) !!}
					</td>
				</tr>
				<tr>
					<td><strong>Setor de Trabalho no Céu</strong></td>
					<td>
						{!! Form::text('sector', !is_null($owner) ? $owner->sector : "", ['class' => 'form-control select2', 'placeholder' => 'Setor de trabalho no CEU, se não for vizinho']) !!}
					</td>
				</tr>
				<tr>
					<td><strong>Horário que Guarda o Carro:</strong></td>
					<td>
						{!! Form::text('timetable', !is_null($owner) ? $owner->timetable : "", ['class' => 'form-control select2', 'placeholder' => 'Horário que vai guardar o carro']) !!}
					</td>
				</tr>
				<tr>
					<td><strong>Dia de Pagamento:</strong></td>
					<td>
						{!! Form::select('payday', $paydays, !is_null($owner) ? $owner->payday : "", ['class' => 'form-control select2', 'placeholder' => 'Escolha o dia de pagamento']) !!}
					</td>
				</tr>
				<tr>
					<td><strong>Valor:</strong></td>
					<td>
						R$ {!! Form::text('value', !is_null($owner) ? number_format($owner->value, 2, ',', '.') : "", ['class' => 'form-control select2', 'placeholder' => 'Valor do aluguel']) !!}
					</td>
				</tr>
				<tr>
					<td><strong>Observação:</strong></td>
					<td>
						{!! Form::textarea('obs', !is_null($owner) ? $owner->obs : "", ['class' => 'form-control select2', 'placeholder' => 'Observação']) !!}
					</td>
				</tr>
				<tr>
					<td colspan="2"><strong>Telefone(s)</strong></td>
				</tr>


				@if(!$phones == null)

					@foreach($phones as $phone)

						<tr>
							<td colspan="2">

								{!! Form::hidden('phoneid[]', $phone->id) !!}

								<strong>Número:</strong> {!! Form::text('phonenumber[]', $phone->number, ['class' => 'form-control select2', 'placeholder' => 'Numero do Telefone']) !!}

								<strong>Tipo:</strong> {!! Form::select('phonetype[]', [1 => 'Fixo',2 => 'Celular'], $phone->type, ['class' => 'form-control select2', 'placeholder' => 'Tipo do Telefone']) !!}

								<strong>Operadora:</strong> {!! Form::select('phonecompany[]', ['Oi'=>'Oi', 'TIM'=>'TIM', 'Vivo'=>'Vivo', 'Claro'=>'Claro', 'Nextel'=>'Nextel', 'Correiros'=>'Correiros', 'PortoTelecon'=>'PortoTelecon'], $phone->company, ['class' => 'form-control select2', 'placeholder' => 'Operadora do Telefone']) !!}

							</td>
						</tr>

					@endforeach

				@else

					<tr>
						<td colspan="2">

							<strong>Número:</strong> {!! Form::text('phonenumber[]', NULL, ['class' => 'form-control select2', 'placeholder' => 'Numero do Telefone']) !!}

							<strong>Tipo:</strong> {!! Form::select('phonetype[]', [1 => 'Fixo',2 => 'Celular'], NULL, ['class' => 'form-control select2', 'placeholder' => 'Tipo do Telefone']) !!}

							<strong>Operadora:</strong> {!! Form::select('phonecompany[]', ['Oi'=>'Oi', 'TIM'=>'TIM', 'Vivo'=>'Vivo', 'Claro'=>'Claro', 'Nextel'=>'Nextel', 'Correiros'=>'Correiros', 'PortoTelecon'=>'PortoTelecon'], NULL, ['class' => 'form-control select2', 'placeholder' => 'Operadora do Telefone']) !!}

						</td>
					</tr>

				@endif

				<tr>
					<td colspan="2"><strong>Dados do Carro</strong></td>
				</tr>

				@if(!$cars == null)

					@foreach($cars as $car)

						<tr>
							<td colspan="2">

								{!! Form::hidden('carid[]', $car->id) !!}

								<strong>Marca:</strong> {!! Form::text('carbrand[]', $car->brand, ['class' => 'form-control select2', 'placeholder' => 'Marca do Carro']) !!}

								<strong>Modelo:</strong> {!! Form::text('carmodel[]', $car->model, ['class' => 'form-control select2', 'placeholder' => 'Modelo do Carro']) !!}

								<strong>Cor:</strong> {!! Form::text('carcolor[]', $car->color, ['class' => 'form-control select2', 'placeholder' => 'Cor do Carro']) !!}

								<strong>Placa:</strong> {!! Form::text('carplate[]', $car->plate, ['class' => 'form-control select2', 'placeholder' => 'Placa do Carro']) !!}

							</td>
						</tr>

					@endforeach

				@else
						<tr>
							<td colspan="2">

								<strong>Marca:</strong> {!! Form::text('carbrand[]', NULL, ['class' => 'form-control select2', 'placeholder' => 'Marca do Carro']) !!}

								<strong>Modelo:</strong> {!! Form::text('carmodel[]', NULL, ['class' => 'form-control select2', 'placeholder' => 'Modelo do Carro']) !!}

								<strong>Cor:</strong> {!! Form::text('carcolor[]', NULL, ['class' => 'form-control select2', 'placeholder' => 'Cor do Carro']) !!}

								<strong>Placa:</strong> {!! Form::text('carplate[]', NULL, ['class' => 'form-control select2', 'placeholder' => 'Placa do Carro']) !!}

							</td>
						</tr>

				@endif

			</tbody>
		</table>

		<button class="btn btn-warning">Enviar</button>

	{!! Form::close() !!}

	<br><br>

	<a href="javascript:history.go(-1);">
		<button class="btn btn-success">Voltar</button>
	</a>

@endsection