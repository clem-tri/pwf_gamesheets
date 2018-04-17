<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('editeur_id')->unsigned();
            $table->integer('developpeur_id')->unsigned();
            $table->integer('genre_id')->unsigned();
            $table->string('nom');
            $table->date("annee");
            $table->string('image');
            $table->text('synopsis')->nullable();
            $table->tinyInteger("en_ligne");
            $table->string('site')->nullable();
            $table->integer('created_by')->unsigned();
            $table->foreign('editeur_id')->references('id')->on('editeurs')->onDelete('cascade');
            $table->foreign('developpeur_id')->references('id')->on('developpeurs')->onDelete('cascade');
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('fiches', function(Blueprint $table) {
            $table->dropForeign('fiches_genre_id_foreign');
        });
        Schema::table('fiches', function(Blueprint $table) {
            $table->dropForeign('fiches_user_id_foreign');
        });
        Schema::table('fiches', function(Blueprint $table) {
            $table->dropForeign('fiches_editeur_id_foreign');
        });
        Schema::table('fiches', function(Blueprint $table) {
            $table->dropForeign('fiches_developpeur_id_foreign');
        });
        Schema::dropIfExists('fiches');
    }
}
