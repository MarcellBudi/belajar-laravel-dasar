<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use Tests\TestCase;
// use Faker\Provider\ar_EG\Person;
use App\Data\Person;
use App\Services\HelloServiceIndonesia;
use function PHPUnit\Framework\assertEquals;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceContainerTest extends TestCase
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
    public function testDependency()
    {
        $foo1 = $this->app->make(Foo::class); // new Foo()
        $foo2 = $this->app->make(Foo::class); // new Foo()

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }

    public function testBind() {
        $this->app->bind(Person::class, function ($app) {
            return new Person("Marcell", "Budi");
        });

        $person1 = $this->app->make(Person::class); // closure() // new Person("Marcell", "Budi");
        $person2 = $this->app->make(Person::class); // closure() // new Person("Marcell", "Budi");

        self::assertEquals('Marcell', $person1->firstName);
        self::assertEquals('Marcell', $person2->firstName);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton() {
        $this->app->singleton(Person::class, function ($app) {
            return new Person("Marcell", "Budi");
        });

        $person1 = $this->app->make(Person::class); // new Person("Marcell", "Budi"); if not exists
        $person2 = $this->app->make(Person::class); // renturn existing
        $person3 = $this->app->make(Person::class); // renturn existing
        $person4 = $this->app->make(Person::class); // renturn existing

        self::assertEquals('Marcell', $person1->firstName);
        self::assertEquals('Marcell', $person2->firstName);
        self::assertSame($person1, $person2);
    }
    public function testInstance() {
        $person = new Person("Marcell", "Budi");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // person
        $person2 = $this->app->make(Person::class); // person
        $person3 = $this->app->make(Person::class); // person
        $person4 = $this->app->make(Person::class); // person

        self::assertEquals('Marcell', $person1->firstName);
        self::assertEquals('Marcell', $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testDependencyInjection()
    {
        $this->app->singleton(Foo::class, function ($app){
            return new Foo();
        });
        $this->app->singleton(Bar::class, function ($app){
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar1->foo);
        self::assertSame($bar1, $bar2);
    }

    public function testInterfaceToClass()
    {
        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $this->app->singleton(HelloService::class, function ($app){
            return new HelloServiceIndonesia();
        });

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals('Halo Marcell', $helloService->hello('Marcell'));
    }
}
