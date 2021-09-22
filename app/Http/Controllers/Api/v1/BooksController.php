<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookPostRequest;
use App\Models\Book;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status_code' => 201,
            'status' => 'success',
            'data' => Book::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BookPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookPostRequest $request)
    {
        $book = Book::create(
            $request->only([
                'name','isbn','authors','country','number_of_pages','publisher','release_date'
            ])
        );

        return response()->json([
            'status_code' => 201,
            'status' => 'success',
            'data' => $book
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $book = Book::find($id);
        } catch (Exception $e) {
            Log::alert("Something went wrong. " . $e->getMessage());
        }

        return response()->json([
            'status_code' => 201,
            'status' => 'success',
            'data' => $book == null ?[]:$book // If book is null return empty array
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BookPostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookPostRequest $request, $id)
    {
        try {
            $book = Book::find($id);

            $book->update(
                $request->only([
                    'name','isbn','authors','country','number_of_pages','publisher','release_date'
                ])
            );
        } catch (Exception $exception) {
            Log::alert("Something went wrong. " . $exception->getMessage());
        } catch (Error $error) {
            Log::alert("An error occured. " . $error->getMessage());
        }

        return response()->json([
            'status_code' => 201,
            'status' => 'success',
            'data' => $book == null ?[]:$book // If book is null return empty array
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $book = Book::find($id);
            $book->delete();
            $data = [];
        } catch (Exception $e) {
            Log::alert("Something went wrong. " . $e->getMessage());
        }

        return response()->json([
            'status_code' => 204,
            'status' => 'success',
            'data' => empty($data) ?$data:$book // Return book data if delete failed
        ]);
    }
}
