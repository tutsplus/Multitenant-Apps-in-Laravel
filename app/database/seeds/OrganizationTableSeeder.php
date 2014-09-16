<?php

class OrganizationTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('organizations')->truncate();

        File::deleteDirectory('app/database/tenants/', true);

        OrganizationSetup::create(['name' => 'Toodoo', 'slug' => 'toodoo']);
        OrganizationSetup::create(['name' => 'Envato', 'slug' => 'envato']);
    }
}
