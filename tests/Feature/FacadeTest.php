<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FacadeTest extends TestCase
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
    public function testConfig()
    {
        $firstName1 = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');

        self::assertEquals($firstName1, $firstName2);

        var_dump(Config::all());
    }

    public function testConfigDependency()
    {
        $config = $this->app->make('config');
        $firstName3 = $config->get('contoh.author.first');

        $firstName1 = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');

        self::assertEquals($firstName1, $firstName2);
        self::assertEquals($firstName1, $firstName3);

        var_dump($config->all());
    }

    public function testFacadeMock()
    {
        Config::shouldReceive('get')
            ->with('contoh.author.first')
            ->andReturn('Marcell Keren');

        $firstName = Config::get('contoh.author.first');

        self::assertEquals('Marcell Keren', $firstName);
    }

}
