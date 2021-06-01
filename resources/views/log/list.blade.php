@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">

					<div class="col-sm-12">
						<a type="button" class="pull-left" href="{{ url('home') }}"><- voltar</a>
					</div>

					<div class="col-sm-12">
						<h1 class="text-center">
							Logs
						</h1>
					</div>

					<table class="table">
						<thead>
						<tr>
							<th class="col-sm-3">NewsLetter</th>
							<th class="col-sm-3" >E-mail</th>
							<th class="col-sm-3" >Data/Hora do envio</th>
						</tr>
						</thead>
						<tbody>
						@if($data)
							@foreach($data as $data)	
							<tr>
								<td scope="row">{{ $data['titulo'] }}</td>
								<td scope="row">
									<button 
										type="button" 
										class="btn-link btn-sm" 
										data-toggle="tooltip" 
										data-placement="bottom" 
										title="{{ $data['email'] }}">
										{{ $data['nome'] }}
									</button>
								</td>
								<td scope="row">{{ $data['created_at'] }}</td>
							</tr>
							@endforeach
						@else
							<tr>
								<td>Não foram encontrados NewsLetters enviados!</td>
							</tr>
						@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
