<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;

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
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
