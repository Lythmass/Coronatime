<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('countries', function (Blueprint $table) {
			$table->id()->references('id')->on('statistics')->onDelete('cascade');
			$table->string('code');
			$table->string('en');
			$table->string('ka');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('countries');
	}
};
