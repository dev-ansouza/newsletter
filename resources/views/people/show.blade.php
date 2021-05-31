@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">

					<div class="col-sm-12">
						<h1 class="text-center">
							Visualizando Pessoa
						</h1>
					</div>

                    <form method="POST">

                        <input type="hidden" name="id" name="id" value="<?php echo $people->id ?>">

                        <div class="form-group">
                            <label for="titulo">Nome</label>
                            <input type="titulo" 
                            style="width: 30%;" 
                            class="form-control" 
                            id="nome"
                            name="nome"
                            placeholder="Nome"  
                            required 
                            disabled
                            value="<?php echo $people->nome ?>">
                        </div>

                        <div class="form-group">
                            <label for="titulo">E-mail</label>
                            <input type="email" 
                            style="width: 30%;" 
                            class="form-control" 
                            id="email" 
                            name="email" 
                            placeholder="E-mail" 
                            required
                            disabled
                            value="<?php echo $people->email ?>">
                        </div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <a type="button" class="btn btn-default" href="{{ url('home/people') }}">Voltar</a>
                        </div>

                    </form>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection('content')