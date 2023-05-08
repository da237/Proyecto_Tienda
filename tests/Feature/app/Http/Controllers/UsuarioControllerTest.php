<?php

namespace Tests\Feature\app\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UsuarioControllerTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     */
    public function testAll(): void
    {
        $users = User::factory(4)->create();
        $expected = [
            "current_page" => 1,
            "data" => $users->toArray(),
            "first_page_url" => "http://localhost/usuarios/all?page=1",
            "from" => 1,
            "last_page" => 1,
            "last_page_url" => "http://localhost/usuarios/all?page=1",
            "links" => [
                [
                    "url" => null,
                    "label" => "&laquo; Previous",
                    "active" => false,
                ],
                [
                    "url" => "http://localhost/usuarios/all?page=1",
                    "label" => "1",
                    "active" => true,
                ],
                [
                    "url" => null,
                    "label" => "Next &raquo;",
                    "active" => false,
                ],
            ],
            "next_page_url" => null,
            "path" => "http://localhost/usuarios/all",
            "per_page" => 5,
            "prev_page_url" => null,
            "to" => 3,
            "total" => 3,
        ];
        $response = $this->getJson(route('usuarios.all'));
        $response->assertStatus(200);
        $response->assertJson($expected);


    }
}
