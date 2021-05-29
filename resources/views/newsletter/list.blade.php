@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">

					<div class="col-sm-12">
						<a type="button" class="pull-right" href="{{ url('home') }}"><- voltar</a>
					</div>

					<div class="col-sm-12">
						<h1 class="text-center">
							NewsLetters
						</h1>
					</div>

					<div class="col-sm-12">
						<div class="btn-group pull-right">
							<button type="button" class="btn btn-danger">
								<span class="glyphicon glyphicon-plus"></span>
								Novo
							</button>
						</div>
					</div>

					<table class="table">
						<thead>
						<tr>
							<th>#</th>
							<th>Título</th>
							<th>Autor</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<th scope="row">1</th>
							<td>Felicidade</td>
							<td>Arthur</td>
						</tr>
						<tr>
							<th scope="row">2</th>
							<td>Otimismo</td>
							<td>José</td>
						</tr>
						<tr>
							<th scope="row">3</th>
							<td>Teste</td>
							<td>Testador</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
