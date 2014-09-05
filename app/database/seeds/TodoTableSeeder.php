<?php

class TodoTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('todos')->truncate();

        foreach(Organization::all() as $org) {
            Todo::create(['name' => 'First Todo', 'user_id'       => $org->users[0]->id, 'organization_id' => $org->id, 'completed' => true]);
            Todo::create(['name' => 'Second Todo', 'user_id'      => $org->users[0]->id, 'organization_id' => $org->id]);
            Todo::create(['name' => 'Todo from Second', 'user_id' => $org->users[1]->id, 'organization_id' => $org->id]);
            Todo::create(['name' => 'Third Todo', 'user_id'       => $org->users[0]->id, 'organization_id' => $org->id]);
        }
    }
}
