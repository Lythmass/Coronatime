<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('statistics', function (Blueprint $table) {
			$table->id();
			$table->string('country');
			$table->string('code');
			$table->string('confirmed');
			$table->string('recovered');
			$table->string('death');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('statistics');
	}
};
