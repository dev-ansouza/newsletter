<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Controllers\Controller;
use App\People;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;

class PeopleController extends Controller {

	use AuthenticatesAndRegistersUsers;

	/**
	 * Responsável pela funcionalidade da listagem de pessoas.
	 
	 * @return Response
	 */
	public function index(Request $request)
	{
		//Armazena o id do usuário logado
		$user_id = Auth::user()->id;

		//Retorna todas as pessoas vinculadas ao usuário logado
		$results = DB::table('peoples')
					->join('users', 'peoples.user_id', '=', 'users.id')
					->where('peoples.user_id', '=', $user_id)
					->select('peoples.*', 'users.name')
					->get();

		//Converte os resultados para JSON e armazena na array $peoples
		$peoples['peoples'] = json_decode(json_encode($results), true);

		//Retorna a view com os parametros a serem usados
		return view('people/list', $peoples);
	}

	/**
	 * Retorna a view de criação.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('people/create');
	}

	/**
	 * Salva os dados da pessoa no DB
	 *
	 * @param \Illuminate\Http\Request $request
	 */
	public function store(Request $request)
	{
		//Armazena os dados da requisição
		$data = $request->all();

		//Armazena o id do usuário logado
		$user_id = Auth::user()->id;

		//Verifica se está em edição
		if (!empty($data['id'])) {

			//Definição da array que armazenará os dados a serem salvos
			$people = [
				'id' => $data['id'],
				'nome' => $data['nome'],
				'email' => $data['email'],
				'user_id' => $user_id
			];

			//Se retornar falso, não existe pessoa cadastrada com o mesmo nome
			if($this->verifyPeople($people, $user_id) === true){

				DB::table('peoples')
				->where('peoples.id', '=', $data['id'])
				->update($people); 

			} else {

				// //Retorna mensagem de erro
				// return redirect()->back()->with('error', 'Pessoa já cadastrada!');
			}

		} else {

			//Definição da array que armazenará os dados a serem salvos
			$people = [
				'nome' => $data['nome'],
				'email' => $data['email'],
				'user_id' => $user_id
			];

			//Se retornar falso, não existe pessoa cadastrada com o mesmo email
			if($this->verifyPeople($people, $user_id) === false){
				
				//Cria uma nova pessoa.
				People::create($people);

			} else {

				// $error = [
				// 	'message' => 'Pessoa já cadastrada!'
				// ];

				//Retorna mensagem de erro
				// return $error;
			}
		}

		//Retorna para a view de listagem
		return redirect('/home/people');
	}

	/**
	 * Retorna a view de visualização de pessoa.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//Retorna a pessoa a ser visualizada
		$result = DB::table('peoples')
		->where('peoples.id', '=', $id)
		->select('peoples.*')
		->get();

		//Armazena os dados
		$people = $result[0];

		//Retorna a view com os parametros a serem usados
		return view('people/show', ['people' => $people]);
	}

	/**
	 * Atualiza os dados de uma pessoa em edição.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//Retorna a pessoa a ser editada
		$result = DB::table('peoples')
		->where('peoples.id', '=', $id)
		->select('peoples.*')
		->get();

		//Armazena os dados
		$people = $result[0];

		//Retorna a view com os parametros a serem usados
		return view('people/update', ['people' => $people]);		
	}

	/**
	 * Verifica se já existe a pessoa com o mesmo email especificado no formulário vinculada ao usuário logado
	 * 
	 * @param array $data
	 * @param integer $user_id
	 */
	public function verifyPeople($data, $user_id) 
	{
		//Se estiver em edição
		if (!empty($data['id'])) {

			//Query que faz a verificação
			$request = DB::table('peoples')
			->where('peoples.user_id', '=', $user_id ) 
			->where('peoples.email', '=', $data['email'])
			->where('peoples.id', '=', $data['id'])
			->select('peoples.*')
			->get();

			//Retorna true se encontrar uma pessoa com os mesmos dados do formulário
			return true;


		} else {

			//Query que faz a verificação
			$request = DB::table('peoples')
			->where('peoples.user_id', '=', $user_id ) 
			->where('peoples.email', '=', $data['email'])
			->select('peoples.*')
			->get();

			//Retorna true se não encontrar uma pessoa com os mesmos dados do formulário
			return false;
		}

	}

	/**
	 * Remove uma pessoa.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//Remove uma pessoa
		$result = DB::table('peoples')
		->where('peoples.id', '=', $id)
		->delete();
		
		//Retorna a view com os parametros a serem usados
		return redirect('/home/people');	
	}

}
