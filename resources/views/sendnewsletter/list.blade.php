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
							Send NewsLetter
						</h1>
					</div>

					<div class="col-sm-12">
						<div class="btn-group pull-right">
							<a type="button" class="btn btn-primary" href="{{ url('/home/sendnewsletter/send') }}">
								<span class="glyphicon glyphicon-plus"></span>
								Enviar
							</a>
						</div>
					</div>

					<table class="table">
						<thead>
						<tr>
							<th class="col-sm-3">NewsLetter</th>
							<th class="col-sm-4">Data/Hora do envio</th>
						</tr>
						</thead>
						<tbody>
						@if($data)
							@foreach($data as $data)	
							<tr>
								<td scope="row">{{ $data['titulo'] }}</td>
								<td scope="row">{{ $data['created_at'] }}</td>
							</tr>
							@endforeach
						@else
							<tr>
								<td>Não foram encontradas NewsLetters enviadas!</td>
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
