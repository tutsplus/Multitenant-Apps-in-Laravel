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
                'password' => Hash::make($username)
            ]);
        }

        $adminUser = User::where('name', 'Admin')->first();
        $adminUser->admin = true;
        $adminUser->save();
    }
}
