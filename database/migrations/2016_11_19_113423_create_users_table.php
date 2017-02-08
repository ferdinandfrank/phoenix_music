<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name', config('validation.user.name.max'));
            $table->string('email', config('validation.user.email.max'))->unique();
            $table->string('password', 60);
            $table->unsignedInteger('user_type')->default(0);
            $table->date('birthday')->nullable();
            $table->string('role', config('validation.user.role.max'))->nullable();
            $table->text('about')->nullable();
            $table->string('image')->nullable();
            $table->string('url', config('validation.user.url.max'))->nullable();
            $table->string('twitter', config('validation.user.twitter.max'))->nullable();
            $table->string('facebook', config('validation.user.facebook.max'))->nullable();
            $table->string('github', config('validation.user.github.max'))->nullable();
            $table->string('linkedin', config('validation.user.linkedin.max'))->nullable();
            $table->string('instagram', config('validation.user.instagram.max'))->nullable();;
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }
}
