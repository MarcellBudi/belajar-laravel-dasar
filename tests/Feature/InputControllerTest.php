<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
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

    public function testInput()
    {
        $this->get('/input/hello?name=Marcell')
            ->assertSeeText('Hello Marcell');

        $this->post('/input/hello', [
            'name' => 'Marcell'
        ])->assertSeeText('Hello Marcell');
    }

    public function testInputNested()
    {
        $this->post('/input/hello/first', [
            "name" => [
                "first" => "Marcell",
                "last" => "Budi"
            ]
        ])->assertSeeText("Hello Marcell");
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            "name" => [
                "first" => "Marcell",
                "last" => "Budi"
            ]
        ])->assertSeeText("name")->assertSeeText("first")
            ->assertSeeText("last")->assertSeeText("Marcell")
            ->assertSeeText("Budi");
    }
    
    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            "products" => [
                [
                    "name" => "Apple Mac Book Pro",
                    "price" => 30000000
                ],
                [
                    "name" => "Samsung Galaxy S10",
                    "price" => 15000000
                ]
            ]
        ])->assertSeeText("Apple Mac Book Pro")
            ->assertSeeText("Samsung Galaxy S10");
    }
}
