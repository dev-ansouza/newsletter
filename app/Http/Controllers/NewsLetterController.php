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
	 *
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
// dd($data);
		//Verifica se está em edição
		if (!empty($data['id'])) {

			dd('to if');


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
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
	 * Update the specified resource in storage.
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

		$newsletter = $result[0];
		// dd($newsletter); 

		//Retorna a view com os parametros a serem usados
		return view('newsletter/update', ['newsletter' => $newsletter]);		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
