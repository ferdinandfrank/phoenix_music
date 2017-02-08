<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('title', config('validation.album.title.max'));
            $table->text('description')->nullable();
            $table->text('tags')->nullable();
            $table->string('image')->nullable();
            $table->string('audiojungle', config('validation.album.audiojungle.max'))->nullable();
            $table->string('stye', config('validation.album.stye.max'))->nullable();
            $table->string('cdbaby', config('validation.album.cdbaby.max'))->nullable();
            $table->string('amazon', config('validation.album.amazon.max'))->nullable();
            $table->string('itunes', config('validation.album.itunes.max'))->nullable();
            $table->date('published_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('albums');
    }
}
