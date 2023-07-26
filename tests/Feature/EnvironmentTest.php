<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Env;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EnvironmentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    public function testGetEnv()
    {
        $linkedin = env('LINKEDIN');

        self::assertEquals('Marcell Budi Putra', $linkedin);
    }

    public function testDefaultEnv()
    {
        $autors = Env::get('AUTHOR', 'Marcell');

        self::assertEquals('Marcell', $autors);
    }
}
