<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ItemTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_auth()
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'admin@example.com',
            'password' => 'Password123#@!'
        ]);

        $response->assertStatus(201);
        $response->assertSee('accessToken');

        $itemListWithNoAuth = $this->post('/api/item/list');
        $itemListWithNoAuth->assertStatus(405);
    
    }
}
