<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FireAndIceService
{
    private $response;

    public function __construct()
    {
        $this->response = [
            'status_code' => 200,
            'status' => 'success',
            'data' => []
        ];
    }

    public function getdata(string $name)
    {
        $booksCollection = collect();

        if (is_null($name) || $name == '') {
            return $this->response;
        }

        try {
            $response = Http::get("https://www.anapioficeandfire.com/api/books" . "?name=" . $name);

            $books = $response->collect();
            $booksCollection = collect();

            foreach ($books as $book) {
                $bookCollection = collect($book);
                $bookCollection = $bookCollection->only(['name','isbn','authors','number_of_pages','publisher','country','released']);
                $booksCollection->push($bookCollection);
            }
        } catch (Exception $e) {
            Log::alert("Something went wrong!!! " . $e->getMessage());
        }

        $this->response['data'] = $booksCollection->toArray();

        return $this->response;
    }
}
