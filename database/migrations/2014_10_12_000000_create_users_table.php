<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {


			$table->bigIncrements('id');
			$table->string('role');
			$table->string('name');
			$table->string('surname')->nullable();
			$table->string('nick')->unique();
			$table->string('email')->unique();
			$table->string('password');
			$table->string('image')->nullable();
			$table->timestamps();
			$table->rememberToken();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}
}
