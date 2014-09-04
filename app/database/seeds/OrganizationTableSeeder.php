<?php

class OrganizationTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('organizations')->truncate();

        Organization::create(['name' => 'Toodoo']);
        Organization::create(['name' => 'Envato']);
    }
}
