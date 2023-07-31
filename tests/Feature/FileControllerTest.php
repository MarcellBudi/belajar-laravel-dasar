<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileControllerTest extends TestCase
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

    public function testUpload()
    {
        $picture = UploadedFile::fake()->image('marcell.png');

        $this->post('/file/upload', [
            'picture' => $picture
        ])->assertSeeText("OK marcell.png");
    }
}
