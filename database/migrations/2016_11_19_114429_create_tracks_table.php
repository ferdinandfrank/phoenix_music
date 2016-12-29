<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTracksTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tracks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('composer_id')->index();
            $table->unsignedInteger('album_id')->nullable();
            $table->string('file');
            $table->string('length');
            $table->integer('bpm');
            $table->text('tags')->nullable();
            $table->string('image')->nullable();
            $table->string('audiojungle')->nullable();
            $table->string('stye')->nullable();
            $table->string('cdbaby')->nullable();
            $table->string('amazon')->nullable();
            $table->string('itunes')->nullable();
            $table->string('youtube')->nullable();
            $table->date('published_at');
            $table->timestamps();

            $table->foreign('composer_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('album_id')
                ->references('id')
                ->on('albums')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tracks');
    }
}
