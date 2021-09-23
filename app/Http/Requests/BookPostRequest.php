<?php

namespace App\Http\Requests;

use App\Models\Book;
use App\Rules\UniqueIsbn;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'isbn' => ["required", new UniqueIsbn($this->book)],
            'authors' => 'required|array',
            'authors.*' => 'required|string|distinct',
            'country' => 'required|string',
            'number_of_pages' => 'required',
            'publisher' => 'required',
            'release_date' => 'required'
        ];
    }
}
