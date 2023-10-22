<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // CREATE BOOK METHOD
    public function createBook(Request $request)
    {
        //validation
        $request->validate([
            'title' => 'required',
            'price' => 'required',
        ]);

        // create book data & save

        $book = new Book();

        $book->author_id = auth()->user()->id;
        $book->title = $request->title;
        $book->price = $request->price;
        $book->description = $request->description;

        $book->save();

        // send response

        return response()->json([
            'status' => 1,
            'message' => 'Book created successfully',
        ]);

    }

    // LIST BOOOK METHOD
    public function authorBook()
    {
        $id = auth()->user()->id;
        $books = Author::find($id)->books;

        return response()->json([
            'status' => 1,
            'message' => 'Books list',
            'data' => $books,
        ]);

    }

    // SINGLE BOOK METHOD
    public function singleBook($book_id)
    {
        $author_id = auth()->user()->id;

        if (Book::where([
            'author_id' => $author_id,
            'id' => $book_id,
        ])->exists()) {
            $book = Book::find($book_id);

            return response()->json([
                'status' => 1,
                'message' => 'Book Detail',
                'data' => $book,
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Book not found',
            ]);
        }

    }

    // UPDATE METHOD
    public function updateBook(Request $request, $book_id)
    {
        $author_id = auth()->user()->id;

        if (Book::where([
            'author_id' => $author_id,
            'id' => $book_id,
        ])->exists()) {
            $book = Book::find($book_id);

            $book->title = isset($request->title) ? $request->title : $book->title;
            $book->description = isset($request->description) ? $request->description : $book->description;
            $book->price = isset($request->price) ? $request->price : $book->price;

            $book->save();

            return response()->json([
                'status' => 1,
                'message' => 'Book Updated Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Book not found',
            ]);
        }

    }

    // DELETE METHOD
    public function deleteBook($book_id)
    {
        $author_id = auth()->user()->id;

        if (Book::where([
            'author_id' => $author_id,
            'id' => $book_id,
        ])->exists()) {

            Book::find($book_id)->delete();

            return response()->json([
                'status' => 1,
                'message' => 'Book Successfully Deleted',
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Book not found',
            ]);
        }

    }
}
