<?php

namespace App\Rules;

use App\Models\Book;
use Exception;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;

class UniqueIsbn implements Rule
{
    protected $book;

    public function __construct($id)
    {
        $this->book = Book::find($id);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $book = Book::where('isbn', $value)->first();

        if (is_null($book)) {
            return true;
        }

        try {
            if ($book->id == $this->book->id) {
                return true;
            }
        } catch (Exception $exception) {
            Log::alert("Something went wrong. " . $exception->getMessage());
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The ISBN exists already.';
    }
}
