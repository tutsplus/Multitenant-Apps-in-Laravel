<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('email', 140)->index();
            $table->string('password', 140)->index();
            $table->string('remember_token', 100)->index()->nullable();
            $table->string('name', 255)->nullable();
            $table->boolean('admin')->default(false)->nullable();
            $table->boolean('active')->default(false)->index()->nullable();
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
        Schema::drop('users');
    }
}
