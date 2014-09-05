<?php

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('organization_user')->truncate();

        $usernames = ['machuga', 'second', 'third', 'admin'];

        foreach(Organization::all() as $org) {
            foreach($usernames as $username) {
                $username = $org->isVendor() ? $username : $username.$org->id;

                $user = User::create([
                    'name'            => ucfirst($username),
                    'email'           => "{$username}@example.com",
                    'password'        => $username,
                    'active'          => true,
                    'admin'           => starts_with($username, 'admin')
                ]);

                $user->organizations()->attach($org->id);
            }
        }
    }
}
