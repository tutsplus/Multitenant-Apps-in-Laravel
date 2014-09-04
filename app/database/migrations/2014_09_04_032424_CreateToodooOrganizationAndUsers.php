<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToodooOrganizationAndUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::transaction(function() {
            Schema::table('users', function(Blueprint $table) {
                $table->integer('organization_id')->nullable()->index();
            });

            $org = Organization::create(['name' => 'Toodoo']);

            DB::table('users')->update(['organization_id' => $org->id]);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::transaction(function() {
            Schema::table('users', function(Blueprint $table) {
                $table->dropColumn('organization_id');
            });

            $org = Organization::vendor();

            $org && $org->delete();
        });
	}

}
