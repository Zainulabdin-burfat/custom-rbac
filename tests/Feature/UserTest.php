<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->withExceptionHandling();

        $attributes = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            // 'password' => bcrypt('password'),
        ];

        $this->post('/users/create', $attributes);

        // $this->assertDatabaseHas('users', $attributes);

        // $this->get('/users')->assertSee($attributes['name']);

    }
    
}
