<?php

use Illuminate\Database\Seeder;

class DefaultTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, 2)->create()->each(function ($user) {
            factory(App\Team::class, rand(1,3))->create(['owner_id' => $user->id])->each(function($team) use ($user) {
                $user->teams()->attach($team->id, ['role'=>'owner']);
            });
        });
    }
}
