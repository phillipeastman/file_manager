<?php

namespace Tests\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\file_metadata;

class FileMetaDataControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testFileMetaDataIndex()
    {
        $response = $this->call('GET', "/api/files");

        $response->assertStatus(200);
    }

    public function testFileMetaDataShow()
    {
        $response = $this->call('GET', "/api/file/1");

        $response->assertStatus(200);
    }
}
