<?php

namespace Tests\Feature;

use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Usertest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $user= User::factory()->create();

        $response = $this->actingAs($user)->get(route('usuarios.all'));

        $response->assertOk();
    }
}
