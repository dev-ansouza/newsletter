<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;

class RelatorioController extends Controller {

	use AuthenticatesAndRegistersUsers;

	/**
	 * Responsável pela funcionalidade da listagem da tela Relatório.
	 
	 * @return Response
	 */
	public function index(Request $request)
	{
		//Armazena o id do usuário logado
		$user_id = Auth::user()->id;

		//Retorna todas as newsletters enviadas vinculadas ao usuário logado e as pessoas que receberam
		$results = DB::table('sendnewsletters')
					->join('users', 'sendnewsletters.user_id', '=', 'users.id')
					->join('newsletters', 'sendnewsletters.newsletter_id', '=', 'newsletters.id')
					->join('peoples', 'sendnewsletters.people_id', '=', 'peoples.id')
					->where('sendnewsletters.user_id', '=', $user_id)
					->select('sendnewsletters.*', 'newsletters.titulo', 'peoples.nome', 'peoples.email')
					->get();

		//Converte os resultados para JSON e armazena na array $data
		$data['data'] = json_decode(json_encode($results), true);

		//Retorna a view com os parametros a serem usados
		return view('relatorio/list', $data);
	}
}
