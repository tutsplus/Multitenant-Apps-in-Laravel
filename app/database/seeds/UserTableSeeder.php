<?php

class UserTableSeeder extends Seeder
{
    public function run()
    {
        foreach (Organization::all() as $org) {
            DB::connection($org->slug)->table('users')->truncate();

            $usernames = ['machuga', 'second', 'third', 'admin'];

            foreach($usernames as $username) {
                $user = new User([
                    'name'     => ucfirst($username),
                    'email'    => "{$username}@example.com",
                    'password' => $username,
                    'active'   => true,
                    'admin'    => starts_with($username, 'admin')
                ]);

                $user->setConnection($org->slug);
                $user->save();
            }
        }
    }
}
