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
							Pessoas
						</h1>
					</div>

					<div class="col-sm-12">
						<div class="btn-group pull-right">
							<a type="button" class="btn btn-primary" href="{{ url('/home/people/new') }}">
								<span class="glyphicon glyphicon-plus"></span>
								Novo
							</a>
						</div>
					</div>

					<table class="table">
						<thead>
						<tr>
							<th class="col-sm-3">Nome</th>
							<th class="col-sm-4">E-mail</th>
							<th class="col-sm-2"></th>
						</tr>
						</thead>
						<tbody>
						@if($peoples)
							@foreach($peoples as $people)	
							<tr>
								<td scope="row">{{ $people['nome'] }}</td>
								<td scope="row">{{ $people['email'] }}</td>
								<td>
									<div class=" pull-right">
										<a type="button" class="btn btn-info btn-sm" href="{{ url('/home/people/update/' . $people['id']) }}">
											<span class="glyphicon glyphicon-pencil"></span>
										</a>
										<a type="button" class="btn btn-default btn-sm" href="{{ url('/home/people/show/' . $people['id']) }}">
											<span class="glyphicon glyphicon-eye-open"></span>
										</a>
										<a type="button" class="btn btn-danger btn-sm" href="{{ url('/home/people/destroy/' . $people['id']) }}">
											<span class="glyphicon glyphicon-trash"></span>
										</a>
									</div>
								</td>
							</tr>
							@endforeach
						@else
							<tr>
								<td>Não foram encontradas pessoas cadastradas!</td>
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
