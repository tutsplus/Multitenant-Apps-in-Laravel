<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToOrganizationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::transaction(function() {
            Schema::table('organizations', function(Blueprint $table) {
                $table->string('slug', 255)->nullable()->index();
            });

            foreach (Organization::all() as $org) {
                $org->slug = Str::slug($org->name);
                $org->save();
            }
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('organizations', function(Blueprint $table) {
            $table->dropColumn('slug');
        });
	}

}
