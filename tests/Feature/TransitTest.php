<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testTransitType()
    {
        $user = factory(\App\User::class)->create()->each(function ($user) {
            factory(\App\Team::class)->create(['owner_id' => $user->id])->each(function($team) use ($user) {
                $user->teams()->attach($team->id, ['role'=>'owner']);
            });
        });
        
        $user = \App\User::find(1);

        // index
        $response = $this->actingAs($user)
            ->get('/transit_types');
        $response->assertStatus(200); 

        // test store
        $response = $this->actingAs($user)
            ->json('POST', '/transit_types', ['title' => 'Sally']);

            dd($response);
        $response
            ->assertStatus(201)
            ->assertJson([
                'message' => true,
            ]);
        
    }
}
