@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">

					<div class="col-sm-12">
						<h1 class="text-center">
							Nova Pessoa
						</h1>
					</div>

                    <form method="POST">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="nome" style="width: 30%;" class="form-control" id="nome" name="nome" placeholder="Nome" autofocus required>
                        </div>

                        <div class="form-group">
                            <label for="titulo">E-mail</label>
                            <input type="email" style="width: 30%;" class="form-control" id="email" name="email" placeholder="E-mail" required>
                        </div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Confirmar</button>
                            <a type="button" class="btn btn-danger" href="{{ url('home/people') }}">Cancelar</a>
                        </div>

                    </form>

				</div>
			</div>
		</div>
	</div>
</div> 
@endsection('content')