<?php

class TodoTableSeeder extends Seeder
{
    public function run()
    {
        foreach (Organization::all() as $org) {
            DB::connection($org->slug)->table('todos')->truncate();

            $users = User::on($org->slug)->get();

            $todos = [
                new Todo(['name' => 'First Todo', 'user_id'       => $users[0]->id, 'completed' => true]),
                new Todo(['name' => 'Second Todo', 'user_id'      => $users[0]->id]),
                new Todo(['name' => 'Todo from Second', 'user_id' => $users[1]->id]),
                new Todo(['name' => 'Third Todo', 'user_id'       => $users[0]->id]),
            ];

            foreach ($todos as $todo) {
                $todo->setConnection($org->slug);
                $todo->save();
            }
        }
    }
}
