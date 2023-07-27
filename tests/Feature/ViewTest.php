<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
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
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Marcell');

        $this->get('/hello-again')
            ->assertSeeText('Hello Marcell');
    }

    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText('World Marcell');
    }

    public function testTemplate()
    {
        $this->view('hello', ['name' => 'Marcell'])
            ->assertSeeText('Hello Marcell');

        $this->view('hello.world', ['name' => 'Marcell'])
            ->assertSeeText('World Marcell');
    }
}
