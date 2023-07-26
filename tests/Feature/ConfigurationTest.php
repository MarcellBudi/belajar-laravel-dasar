<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
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

    public function testConfig() {
        $firstName = config('contoh.author.first');
        $lastName = config('contoh.author.last');
        $email = config('contoh.author.email');
        $linkedin = config('contoh.author.linkedin');

        self::assertEquals('Marcell', $firstName);
        self::assertEquals('Budi', $lastName);
        self::assertEquals('marcellbudiputra@gmail.com', $email);
        self::assertEquals('https://www.linkedin.com/in/marcell-budi-putra/', $linkedin);
    }
}
