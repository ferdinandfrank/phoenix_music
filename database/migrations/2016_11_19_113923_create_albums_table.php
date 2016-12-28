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
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('tags')->nullable();
            $table->string('image')->nullable();
            $table->string('audiojungle')->nullable();
            $table->string('stye')->nullable();
            $table->string('cdbaby')->nullable();
            $table->string('amazon')->nullable();
            $table->string('itunes')->nullable();
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
