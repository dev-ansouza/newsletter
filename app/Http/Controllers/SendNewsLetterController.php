<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Controllers\Controller;
use App\SendNewsLetter;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
					->select('sendnewsletters.*', 'newsletters.titulo')
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
		$request = $request->all();

		//Armazena o id do usuário logado
		$user_id = Auth::user()->id;

		//Retorna os dados da newsletter
		$newsletter = DB::table('newsletters')
				->where('newsletters.id', '=', $request['newsletter_id'])
				->select('newsletters.text')
				->get();
		$newsletter = json_decode(json_encode($newsletter), true);

		//Retorna os dados da pessoa selecionada 
		$peoples = DB::table('peoples')
				->where('peoples.user_id', '=', $user_id)
				->select('peoples.id', 'peoples.email')
				->get();
		$peoples = json_decode(json_encode($peoples), true);

		//Cria uma nova instancia do PHPMailer
		$mail = new PHPMailer(true);

		foreach($peoples as $people){
			try {
				//Server settings
				$mail->SMTPDebug  = SMTP::DEBUG_SERVER;                     //Enable verbose debug output
				$mail->isSMTP();                                            //Send using SMTP
				$mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
				$mail->Username   = 'newsletterlaravel5@gmail.com';         //SMTP username
				$mail->Password   = 'ealfptbuubjtcoue';                     //SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
				$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
	
				//Recipients
				$mail->setFrom('phpmg@newsletter.com', 'PHPMG - NewsLetter');
				$mail->addAddress($people['email']);    				 	//Add a recipient
				// $mail->addReplyTo('info@example.com', 'Information');
				// $mail->addCC('cc@example.com');
				// $mail->addBCC('bcc@example.com');
	
	
				//Content
				$mail->isHTML(true);                                  		//Set email format to HTML
				$mail->Subject = 'PHPMG - NewsLetter';
				$mail->Body    = $newsletter[0]['text'];
				$mail->send();
	
				//Definição da array que armazenará os dados a serem salvos
				$data = [
					'newsletter_id' => $request['newsletter_id'],
					'people_id' => $people['id'],
					'user_id' => $user_id,
				];
	
				//Cria no DB uma nova coluna com os dados de newletter enviados.
				SendNewsLetter::create($data);
	
				//Retorna para a view de listagem
				return redirect('/home/sendnewsletter');
				
			} catch (Exception $e) {
				echo "Mensagem não enviada. Mailer Error: {$mail->ErrorInfo}";
			}
		};

	}
}
