@extends('layouts.padrao')

@section('content')

	<div class="row">

		<div class="col-md-12">

			<h1 title="Pagamentos">Pagamentos</h1>

			<strong>Adicionar Pagamento</strong>

			{!! Form::open(['url' => route('payments.store'), 'class' => 'category-form']) !!}

				<div class="form-group">
	    			<label for="amount" class="label-payments">Valor: R$</label>

					{!! Form::text('amount', NULL, ['class' => 'form-control form-paymentss select2', 'placeholder' => 'Valor Pago']) !!}

				</div>

				<div class="form-group">

					<label for="owner_id" class="label-payments">Proprietário: </label>

					{!! Form::select('owner_id', $allowners, null, ['class' => 'form-control form-paymentss select2', 'placeholder' => 'Selecionar um proprietário']) !!}

				</div>

				<button class="btn btn-warning">Enviar</button>

			{!! Form::close() !!}

		</div>

	</div>

	<div class="row">

		<div class="col-md-12">

			<strong>Pagamentos do mês</strong>

			<table class="table">

				<thead>
					<tr>
						<th>Proprietário</th>
						<th>Dia de Pagamento</th>
						<th>Valor Pago</th>
					</tr>
				</thead>

				<tbody>

					@foreach($payments as $p)

						<tr>
							<td>{{$p->owner['name']}}</td>
							<td>{{$p->payment_date}}</td>
							<td>R$ {{number_format($p->amount, '2', ',', '.')}}</td>
						</tr>

					@endforeach

					<tr>
						<td>Total dessa página</td>
						<td colspan="2">R$ {{number_format($total, '2', ',', '.')}}</td>
					</tr>

				</tbody>

			</table>

			{!!$payments->appends(Request::except('page'))->render()!!}

		</div>

	</div>

	<div class="row">

		<div class="col-md-12">

			<strong>Consulta por Mês</strong>

			{!! Form::open(['url' => route('payments.findDate'), 'class' => 'category-form']) !!}

				<table>

					<tbody>
						<tr>
							<td>Escolha o Mês</td>
							<td>

								{!! Form::select('month', [1=>'Janeiro', 2=>'Fevereiro', 3=>'Março',  4=>'Abril', 5=>'Maio', 6=>'Junho', 7=>'Julho', 8=>'Agosto', 9=>'Setembro', 10=>'Outubro', 11=>'Novembro', 12=>'Dezembro'], $month, ['class' => 'form-control select2', 'placeholder' => 'Selecionar um mês']) !!}

							</td>
							<td>

								{!! Form::text('year', $year, ['class' => 'form-control select2', 'placeholder' => 'Ano']) !!}

							</td>
							<td>
								<button class="btn btn-primary">Pesquisar</button>
							</td>
						</tr>

					</tbody>

				</table>

			{!! Form::close() !!}

		</div>
	</div>

@endsection