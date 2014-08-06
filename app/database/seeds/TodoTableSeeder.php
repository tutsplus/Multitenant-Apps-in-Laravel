<?php

class TodoTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('todos')->truncate();

        $user1 = User::find(1);
        $user2 = User::find(2);
        Todo::create(['name' => 'First Todo', 'user_id' => $user1->id, 'completed' => true]);
        Todo::create(['name' => 'Second Todo', 'user_id' => $user1->id]);
        Todo::create(['name' => 'Todo from Second', 'user_id' => $user2->id]);
        Todo::create(['name' => 'Third Todo', 'user_id' => $user1->id]);
    }
}
