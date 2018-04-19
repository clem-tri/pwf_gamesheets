<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichePictosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiche_pictos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pictogramme_id')->unsigned();
            $table->integer('fiche_id')->unsigned();
            $table->foreign('pictogramme_id')->references('id')->on('pictogrammes')->onDelete('cascade');
            $table->foreign('fiche_id')->references('id')->on('fiches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fiche_pictos', function(Blueprint $table) {
            $table->dropForeign('fiche_pictos_pictogramme_id_foreign');
        });
        Schema::table('fiche_pictos', function(Blueprint $table) {
            $table->dropForeign('fiche_pictos_fiche_id_foreign');
        });
        Schema::dropIfExists('fiche_pictos');
    }
}
