<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
		Schema::create('settings', function (Blueprint $table) {
        	$table->id();
        	$table->string('name');
			$table->string('description');
			$table->string('currency');
			$table->integer('taxeRate')->default(0);
			$table->string('imageUrl');
			$table->string('street');
			$table->string('codePostal')->nullable();
			$table->string('city');
			$table->string('state');
			$table->string('email');
			$table->string('phone');
			$table->string('copyright')->nullable();
        	$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
