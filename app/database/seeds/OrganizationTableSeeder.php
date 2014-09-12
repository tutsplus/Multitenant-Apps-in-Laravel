<?php

class OrganizationTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('organizations')->truncate();

        Organization::create(['name' => 'Toodoo', 'slug' => 'toodoo']);
        Organization::create(['name' => 'Envato', 'slug' => 'envato']);
    }
}
