@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">

					<div class="col-sm-12">
						<h1 class="text-center">
							Novo NewsLetter
						</h1>
					</div>

                    <form>
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="titulo" class="form-control" id="titulo" placeholder="Título">
                        </div>

                        <div class="">
                            <button type="submit" class="btn btn-success">Confirmar</button>
                            <a type="button" class="btn btn-danger" href="{{ url('home/newsletter') }}">Cancelar</a>
                        </div>

                    </form>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection('content')