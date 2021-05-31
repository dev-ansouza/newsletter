<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Controllers\Controller;
use App\NewsLetter;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;

class NewsLetterController extends Controller {

	use AuthenticatesAndRegistersUsers;


	/**
	 * Responsável pela funcionalidade da listagem de newsletters.
	 
	 * @return Response
	 */
	public function index(Request $request)
	{
		//Armazena o id do usuário logado
		$user_id = Auth::user()->id;

		//Retorna todos os newsletters vinculados ao usuário logado
		$results = DB::table('newsletters')
					->join('users', 'newsletters.user_id', '=', 'users.id')
					->where('newsletters.user_id', '=', $user_id)
					->select('newsletters.*', 'users.name')
					->get();

		//Converte os resultados para JSON e armazena na array $newsletters
		$newsletters['newsletters'] = json_decode(json_encode($results), true);

		//Retorna a view com os parametros a serem usados
		return view('newsletter/list', $newsletters);
	}

	/**
	 * Retorna a view de criação.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('newsletter/create');
	}

	/**
	 * Salva os dados de NewsLetter no DB
	 *
	 * @param \Illuminate\Http\Request $request
	 */
	public function store(Request $request)
	{
		//Armazena os dados da requisição
		$data = $request->all();

		//Armazena o id do usuário logado
		$user_id = Auth::user()->id;

		//Definição da arrau que armazenará os dados a serem salvos
		$newsletter = [
			'titulo' => $data['titulo'],
			'text' => $data['text'],
			'user_id' => $user_id
		];

		//Verifica se está em edição
		if (!empty($data['id'])) {

			DB::table('newsletters')
			->where('newsletters.id', '=', $data['id'])
			->update($newsletter); 

		} else {

			//Cria um novo newsletter.
			NewsLetter::create($newsletter);
		}

		//Retorna para a view de listagem
		return redirect('/home/newsletter');

	}

	/**
	 * Retorna a views de visualização de newsletter.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//Retorna o newsletter a ser visualizado
		$result = DB::table('newsletters')
		->where('newsletters.id', '=', $id)
		->select('newsletters.*')
		->get();

		//Armazena os dados
		$newsletter = $result[0];

		//Retorna a view com os parametros a serem usados
		return view('newsletter/show', ['newsletter' => $newsletter]);
	}

	/**
	 * Retorna a view de edição de newsletter com seus dados a serem editados.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
	}

	/**
	 * Atualiza os dados de uma newsletter em edição.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//Retorna o newsletter a ser editado
		$result = DB::table('newsletters')
		->where('newsletters.id', '=', $id)
		->select('newsletters.*')
		->get();

		//Armazena os dados
		$newsletter = $result[0];

		//Retorna a view com os parametros a serem usados
		return view('newsletter/update', ['newsletter' => $newsletter]);		
	}

	/**
	 * Remove um newsletter.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//Remove um newsletter
		$result = DB::table('newsletters')
		->where('newsletters.id', '=', $id)
		->delete();
		
		//Retorna a view com os parametros a serem usados
		return redirect('/newsletter');	
	}
}