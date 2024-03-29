@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>
						Olá,
						<span>{{ Auth::user()->name }}</span>
						!
					</h1>
					<p>O que deseja acessar?</p>
					<div class="row">
						<div class="col-sm-4">
							<a class="btn btn-primary btn-lg" style="width: 100%; height: 200px" role="button" href="{{ url('/home/newsletter') }}">
								<div style="margin-top: 50px;">NewsLetters</div>
								<div>
									<h1 class="glyphicon glyphicon-file"></h1>
								</div>
							</a>
						</div>
						<div class="col-sm-4">
							<a class="btn btn-primary btn-lg" style="width: 100%; height: 200px" href="{{ url('/home/people') }}" role="button">
								<div style="margin-top: 50px;">Pessoas</div>
								<div>
									<h1 class="glyphicon glyphicon-user"></h1>
								</div>
							</a>
						</div>
						<div class="col-sm-4">
							<a class="btn btn-primary btn-lg" style="width: 100%; height: 200px" href="{{ url('/home/log') }}" role="button">
								<div style="margin-top: 50px;">Logs</div>
								<div>
									<h1 class="glyphicon glyphicon-list-alt"></h1>
								</div>
							</a>
						</div>
					</div><br>
					<div class="row">
						<div class="col-sm-12">
							<a class="btn btn-primary btn-lg" style="width: 100%; height: 200px" role="button" href="{{ url('/home/sendnewsletter') }}">
								<div style="margin-top: 50px;">Enviar NewsLetter</div>
								<div>
									<h1 class="glyphicon glyphicon-envelope"></h1>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
