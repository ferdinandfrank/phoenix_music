<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackViewsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('track_views', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index();
            $table->unsignedInteger('track_id');
            $table->unsignedInteger('views_count');
            $table->date('date')->index();

            $table->foreign('track_id')
                ->references('id')
                ->on('tracks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('track_views');
    }
}
