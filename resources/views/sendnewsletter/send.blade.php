@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">

					<div class="col-sm-12">
						<h1 class="text-center">
							Enviar NewsLetter
						</h1>
					</div>

                    <form method="POST">
                        <div class="form-group">
                            <label for="nome">NewsLetter</label>
                            <select style="width: 30%;" class="form-control" id="newsletter_id" name="newsletter_id" placeholder="NewsLetter" autofocus required>
                                <option value="">Selecione uma NewsLetter</option>
                                @foreach($newsletters as $newsletter)
                                    <option value="{{ $newsletter['id'] }}"> {{ $newsletter['titulo'] }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                        <label for="nome">Pessoa(s)</label>
                            <select style="width: 40%;" class="form-control" id="people_id" name="people_id" placeholder="Pessoa(s)" autofocus required>
                                <option value="">Selecione a(s) pessoa(s)</option>
                                @foreach($peoples as $people)
                                    <option value="{{ $people['id'] }}"> {{ $people['nome'] }} - {{ $people['email'] }} </option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Confirmar</button>
                            <a type="button" class="btn btn-danger" href="{{ url('home/sendnewsletter') }}">Cancelar</a>
                        </div>

                    </form>
				</div>
			</div>
		</div>
	</div>
</div> 
@endsection('content')