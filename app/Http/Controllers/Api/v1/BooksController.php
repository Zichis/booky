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
    protected $statusCode;
    protected $statusText;
    protected $message;

    public function __construct()
    {
        $this->statusCode = 500;
        $this->statusText = 'failed';
        $this->message = 'Something went wrong';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->statusText = 'success';
        $this->statusCode = 200;

        return response()->json([
            'status_code' => $this->statusCode,
            'status' => $this->statusText,
            'data' => Book::all()
        ])->setStatusCode($this->statusCode, $this->statusText);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BookPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookPostRequest $request)
    {
        try {
            $book = Book::create(
                $request->only([
                    'name','isbn','authors','country','number_of_pages','publisher','release_date'
                ])
            );
            $this->statusCode = 201;
            $this->statusText = 'success';
        } catch(Exception $exception) {
            Log::alert("Something went wrong. Book not created. " . $exception->getMessage());
        }

        return response()->json([
            'status_code' => $this->statusCode,
            'status' => $this->statusText,
            'data' => $book
        ])->setStatusCode(201, 'success');
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
            $this->statusCode = 200;
            $this->statusText = 'success';
        } catch (Exception $e) {
            Log::alert("Something went wrong. " . $e->getMessage());
        }

        return response()->json([
            'status_code' => $this->statusCode,
            'status' => $this->statusText,
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
            $this->statusCode = 200;
            $this->statusText = 'success';
            $this->message = 'The book My First Book was updated successfully';
        } catch (Exception $exception) {
            Log::alert("Something went wrong. " . $exception->getMessage());
        } catch (Error $error) {
            Log::alert("An error occured. " . $error->getMessage());
        }

        return response()->json([
            'status_code' => $this->statusCode,
            'status' => $this->statusText,
            'message' => $this->message,
            'data' => $book == null ?[]:$book // If book is null return empty array
        ])->setStatusCode($this->statusCode, $this->statusText);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        try {
            $book->delete();
            $this->statusCode = 204;
            $this->statusText = 'success';
            $this->message = 'The book My First Book was updated successfully';
            $book = null;
        } catch (Exception $e) {
            Log::alert("Something went wrong. " . $e->getMessage());
        } catch (Error $error) {
            Log::alert("An error occured. " . $error->getMessage());
        }

        return response()->json([
            'status_code' => $this->statusCode,
            'status' => $this->statusText,
            'message' => $this->message,
            'data' => is_null($book) ? []:$book
        ])->setStatusCode($this->statusCode, $this->statusText);
    }
}
