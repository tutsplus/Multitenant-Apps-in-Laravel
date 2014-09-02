<?php

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->truncate();

        $usernames = ['machuga', 'second', 'third', 'admin'];

        foreach($usernames as $username) {
            User::create([
                'name'     => ucfirst($username),
                'email'    => "{$username}@example.com",
                'password' => $username,
                'active'   => true,
                'admin'    => starts_with($username, 'admin')
            ]);
        }
    }
}
