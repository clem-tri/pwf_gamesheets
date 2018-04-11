<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFicheExtensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiche_extensions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('extension_id')->unsigned();
            $table->integer('fiche_id')->unsigned();
            $table->foreign('extension_id')->references('id')->on('extensions')->onDelete('cascade');
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
        Schema::table('fiche_extensions', function(Blueprint $table) {
            $table->dropForeign('fiche_extensions_extension_id_foreign');
        });
        Schema::table('fiche_extensions', function(Blueprint $table) {
            $table->dropForeign('fiche_extensions_fiche_id_foreign');
        });
        Schema::dropIfExists('fiche_extensions');
    }
}
