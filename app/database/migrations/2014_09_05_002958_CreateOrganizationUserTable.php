<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::transaction(function() {
            Schema::create('organization_user', function(Blueprint $table) {
                $table->increments('id');
                $table->integer('organization_id')->unsigned();
                $table->integer('user_id')->unsigned();
                $table->timestamps();
            });

            foreach(User::all() as $user) {
                $user->organizations()->attach($user->organization_id);
            }

            Schema::table('todos', function(Blueprint $table) {
                $table->integer('organization_id')->unsigned()->nullable();
            });

            foreach(Todo::withUsers()->get() as $todo) {
                $todo->organization_id = $todo->user->organization_id;
                $todo->save();
            }

            Schema::table('users', function(Blueprint $table) {
                $table->dropColumn('organization_id');
            });
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		throw new Exception("Cannot rollback beyond CreateOrganizationUserTable migration without data destruction");
	}

}
