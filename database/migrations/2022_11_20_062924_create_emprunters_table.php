<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emprunters', function (Blueprint $table) {
            $table->id();
            $table->date('dateDebut');
            $table->time('heureDebut');
            $table->integer('duree');
            $table->boolean('etatEmprunt')->default(1);
            $table->boolean('isValider')->default(0);
            $table->foreignId('ressource_id')->constrained('ressources');
            $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('emprunters');
    }
};
