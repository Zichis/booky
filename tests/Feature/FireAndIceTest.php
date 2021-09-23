<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FireAndIceTest extends TestCase
{
    //use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_external_books()
    {
        $response = $this->get('/api/external-books?name=A Game of Thrones');

        $response->assertStatus(200);

        $this->assertEquals($response['status'], 'success');

        $this->assertEquals($response['data'][0]['name'], 'A Game of Thrones');
    }
}
