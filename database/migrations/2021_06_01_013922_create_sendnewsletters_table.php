<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendnewslettersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sendnewsletters', function(Blueprint $table)
		{
			//Armazena o id
			$table->increments('id');

			//Armazena o id do newsletter enviado
			$table->integer('newsletter_id')->unsigned();

			//Referencia a coluna id na tabela 'newsletters'
			$table->foreign('newsletter_id')->references('id')->on('newsletters');

			//Armazena o id da pessoa que recebeu o newsletter enviado
			$table->integer('people_id')->unsigned();

			//Referencia a coluna id na tabela 'peoples'
			$table->foreign('people_id')->references('id')->on('peoples');

			//Armazena o id do usuário que criou o newsletter
			$table->integer('user_id')->unsigned();

			//Referencia a coluna id na tabela 'users'
			$table->foreign('user_id')->references('id')->on('users');

			//Armazena a data e hora da criação e edição
			$table->timestamps();
		});	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sendnewsletters');
	}

}
