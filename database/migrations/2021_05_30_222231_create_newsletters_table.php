<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewslettersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('newsletters', function(Blueprint $table)
		{
			//Armazena o id
			$table->increments('id');

			//Armazena o título do newsletter
			$table->string('titulo');

			//Armazena o conteúdo do newsletter
			$table->string('text', 5000);

			//Armazena o id do usuário que criou o newsletter
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
