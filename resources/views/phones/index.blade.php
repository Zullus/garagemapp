@extends('layouts.padrao')

@section('content')

	<div class="row">

		<div class="col-md-12">

			<h1 title="Telefone">Telefone</h1>

			<table class="table">
				<thead>
					<tr>
						<td>Nome</td>
						<td>Telefones</td>
					</tr>
				</thead>

				<tbody>
					@foreach($phones as $p)

						<tr>
							<td>

								<a href="{!! route('owners.show', ['id' => $p->owner_id]) !!}">
									{{$p->owner['name']}}
								</a>

							</td>
							<td>

								{{$p->number}} -

								@if($p->type == 1)

									Fixo

								@else

									Celular -
									{{$p->company}}

								@endif

							</td>
						</tr>

					@endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection