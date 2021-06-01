<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Controllers\Controller;
use App\SendNewsLetter;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;

class SendNewsLetterController extends Controller {

	use AuthenticatesAndRegistersUsers;

	/**
	 * Responsável pela funcionalidade da listagem da tela de envio de newsletters.
	 
	 * @return Response
	 */
	public function index(Request $request)
	{
		//Armazena o id do usuário logado
		$user_id = Auth::user()->id;

		//Retorna todas as newsletters enviadas e vinculadas ao usuário logado
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
		return view('sendnewsletter/list', $data);
	}

	/**
	 * Retorna a view de envio de newsletter .
	 *
	 * @return Response
	 */
	public function send()
	{
		//Armazena o id do usuário logado
		$user_id = Auth::user()->id;

		//Retorna as newsletters vinculadas ao usuário logado para serem exibidas em um select
		$newsletters = DB::table('newsletters')
				->where('newsletters.user_id', '=', $user_id)
				->select('newsletters.id', 'newsletters.titulo')
				->get();

		//Converte os resultados para JSON e armazena na array $newsletters
		$newsletters['newsletters'] = json_decode(json_encode($newsletters), true);

		//Retorna as pessoas vinculadas ao usuário logado para serem exibidas em um select
		$peoples = DB::table('peoples')
				->where('peoples.user_id', '=', $user_id)
				->select('peoples.id', 'peoples.nome', 'peoples.email')
				->get();

		//Converte os resultados para JSON e armazena na array $peoples
		$peoples['peoples'] = json_decode(json_encode($peoples), true);

		return view('sendnewsletter/send', $newsletters, $peoples);
	}

	/**
	 * Envia email para as pessoas e salva os dados de newsletter enviada no DB
	 *
	 * @param \Illuminate\Http\Request $request
	 */
	public function store(Request $request)
	{
		//Armazena os dados da requisição
		$data = $request->all();

		//Armazena o id do usuário logado
		$user_id = Auth::user()->id;

		//Definição da array que armazenará os dados a serem salvos
		$data = [];

		//Retorna para a view de listagem
		return redirect('/home/people');
	}
}
