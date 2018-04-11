<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichePlateformesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiche_plateformes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plateforme_id')->unsigned();
            $table->integer('fiche_id')->unsigned();
            $table->foreign('plateforme_id')->references('id')->on('plateformes')->onDelete('cascade');
            $table->foreign('fiche_id')->references('id')->on('fiches')->onDelete('cascade');
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
        Schema::table('fiche_plateformes', function(Blueprint $table) {
            $table->dropForeign('fiche_plateformes_plateforme_id_foreign');
        });
        Schema::table('fiche_plateformes', function(Blueprint $table) {
            $table->dropForeign('fiche_plateformes_fiche_id_foreign');
        });
        Schema::dropIfExists('fiche_plateformes');
    }
}
