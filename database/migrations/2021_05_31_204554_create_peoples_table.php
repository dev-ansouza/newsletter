<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeoplesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('peoples', function(Blueprint $table)
		{
			//Armazena o id
			$table->increments('id');

			//Armazena o nome da pessoa
			$table->string('nome');

			//Armazena o email da pessoa
			$table->string('email')->unique();

			//Armazena o id do usuário responsável por criar a pessoa
			$table->integer('user_id')->unsigned();

			//Referencia a coluna id na tabela 'users'
			$table->foreign('user_id')->references('id')->on('users');

			//Armazena a data e hora da criação e edição
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('newsletters');
	}

}
