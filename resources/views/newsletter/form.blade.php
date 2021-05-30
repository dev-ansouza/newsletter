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
                            <input type="titulo" style="width: 30%;" class="form-control" id="titulo" name="titulo" placeholder="Título">
                        </div>

                        <div class="form-group">
                            <textarea id="text" name="text" placeholder="Escreva seu NewsLetter aqui!"></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Confirmar</button>
                            <a type="button" class="btn btn-danger" href="{{ url('home/newsletter') }}">Cancelar</a>
                        </div>

                    </form>

				</div>
			</div>
		</div>
	</div>
</div>

<!-- Adição do editor de texto Tiny e seus plugins -->
<script src="https://cdn.tiny.cloud/1/d6myxrpdwwlhmpojcuo1s0kpjj5ng0is5p7ilo1qds07czq4/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        height: 400,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | fontselect fontsizeselect formatselect | ' +
        'bold italic forecolor backcolor code | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | fullscreen | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
</script>
  
  @endsection('content')