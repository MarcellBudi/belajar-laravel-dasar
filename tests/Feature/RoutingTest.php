<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
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

    public function testGet()
    {
        $this->get('/pzn')
            ->assertStatus(200)
            ->assertSeeText('Hello Marcell Budi Putra');
    }

    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect('/pzn');
    }

    public function testFallback()
    {
        $this->get('/tidakada')
            ->assertSeeText('404 by Marcell Budi Putra');

        $this->get('/tidakadalagi')
            ->assertSeeText('404 by Marcell Budi Putra');

        $this->get('/ups')
            ->assertSeeText('404 by Marcell Budi Putra');
    }

    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText('Product 1');

        $this->get('/products/2')
            ->assertSeeText('Product 2');

        $this->get('/products/1/items/XXX')
            ->assertSeeText("Product 1, Item XXX");

        $this->get('/products/2/items/YYY')
            ->assertSeeText("Product 2, Item YYY");
    }

    public function testRouteParameterRegex()
    {
        $this->get('/categories/100')
            ->assertSeeText('Category 100');

        $this->get('/categories/marcell')
            ->assertSeeText('404 by Marcell Budi Putra');
    }

    public function testRouteParameterOptional()
    {
        $this->get('/users/budi')
            ->assertSeeText('User budi');

        $this->get('/users/')
            ->assertSeeText('User 404');
    }

    public function testRouteConflict()
    {
        $this->get('/conflict/putra')
            ->assertSeeText("Conflict putra");

        $this->get('/conflict/marcell')
            ->assertSeeText("Conflict Ini Marcell");
    }

    public function testNamedRoute()
    {
        $this->get('/produk/12345')
            ->assertSeeText('Link http://localhost/products/12345');

        $this->get('/produk-redirect/12345')
            ->assertRedirect('/products/12345');
    }

}
