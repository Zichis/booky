<?php

namespace Tests\Feature;

use App\Services\FireAndIceService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FireAndIceServiceTest extends TestCase
{
    //use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_data()
    {
        $name = 'A Game of Thrones';

        $service = new FireAndIceService();

        $result = $service->getdata($name);

        $this->assertIsArray($result);

        $this->assertEquals($name, $result['data'][0]['name']);
    }
}
