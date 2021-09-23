<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BooksTest extends TestCase
{
    //use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_book_created()
    {
        $response = $this->postJson('/api/v1/books', [
            'name' => 'My First Book',
            'isbn' => '123-3213243567',
            'authors' => ["John Doe"],
            'country' => "United States",
            'number_of_pages' => 350,
            'publisher' => 'Acme Books',
            'release_date' => '2019-08-01'
        ]);

        $response->assertStatus(201);

        $this->assertEquals($response['status'], 'success');

        $this->assertEquals($response['data']['book']['name'], 'My First Book');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_book_index()
    {
        $response = $this->getJson('/api/v1/books');

        $response->assertStatus(200);

        $this->assertEquals($response['status'], 'success');

        $this->assertEquals($response['data'][0]['name'], 'My First Book');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_book_update()
    {
        $response = $this->putJson('/api/v1/books/1', [
            'name' => 'My Updated Book',
            'isbn' => '123-3213243567',
            'authors' => ["John Doe"],
            'country' => "United States",
            'number_of_pages' => 350,
            'publisher' => 'Acme Books',
            'release_date' => '2019-08-01'
        ]);

        $response->assertStatus(200);

        $this->assertEquals($response['status'], 'success');

        $this->assertEquals($response['message'], 'The book My First Book was updated successfully');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_book_show()
    {
        $response = $this->getJson('/api/v1/books/1');

        $response->assertStatus(200);

        $this->assertEquals($response['status'], 'success');

        $this->assertEquals($response['data']['name'], 'My Updated Book');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_book_delete()
    {
        $response = $this->deleteJson('/api/v1/books/1');

        $response->assertStatus(200);

        //dump($response['status']);
        //dump($response['status_code']);
        //dump($response['message']);

        $this->assertEquals($response['status'], 'success');

        $this->assertEquals($response['message'], 'The book My First Book was deleted successfully');
    }
}
