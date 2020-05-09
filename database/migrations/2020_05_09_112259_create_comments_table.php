<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function (Blueprint $table) {

			$table->bigIncrements('id');
			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('image_id');
			$table->string('content');

			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('image_id')->references('id')->on('images');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('comments');
	}
}
