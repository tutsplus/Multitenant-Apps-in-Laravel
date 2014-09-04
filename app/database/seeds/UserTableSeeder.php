<?php

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->truncate();

        $usernames = ['machuga', 'second', 'third', 'admin'];

        foreach(Organization::all() as $org) {
            foreach($usernames as $username) {
                $username = $org->isVendor() ? $username : $username.$org->id;

                User::create([
                    'organization_id' => $org->id,
                    'name'            => ucfirst($username),
                    'email'           => "{$username}@example.com",
                    'password'        => $username,
                    'active'          => true,
                    'admin'           => starts_with($username, 'admin')
                ]);
            }
        }
    }
}
