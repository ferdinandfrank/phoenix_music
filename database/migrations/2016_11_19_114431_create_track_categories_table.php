<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackCategoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('track_categories', function (Blueprint $table) {
            $table->unsignedInteger('track_id');
            $table->unsignedInteger('category_id');
            $table->timestamps();

            $table->primary(['track_id', 'category_id']);
            $table->foreign('track_id')
                ->references('id')
                ->on('tracks')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
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
        Schema::dropIfExists('track_categories');
    }
}
