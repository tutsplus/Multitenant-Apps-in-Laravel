<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('OrganizationTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('TodoTableSeeder');
    }

}
