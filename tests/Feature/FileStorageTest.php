<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileStorageTest extends TestCase
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

    public function testStorage()
    {
        $filesystem = Storage::disk("local");

        $filesystem->put("file.txt", "Marcell Budi Putra");

        $content = $filesystem->get("file.txt");

        self::assertEquals("Marcell Budi Putra", $content);
    }

    public function testPublic()
    {
        $filesystem = Storage::disk("public");

        $filesystem->put("file.txt", "Marcell Budi Putra");

        $content = $filesystem->get("file.txt");

        self::assertEquals("Marcell Budi Putra", $content);
    }
}
