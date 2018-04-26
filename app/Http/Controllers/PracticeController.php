<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use App;
use Debugbar;
use IanLChapman\PigLatinTranslator\Parser;
use Carbon\Carbon;
use App\Book;

class PracticeController extends Controller
{

    /**
     * Examples of collection magic
     */
    public function practice19()
    {
        $books = Book::all();
        # Treat results as a String
        # echo $books;

        # Treat results as an Array
        # foreach($books as $book) {
        #     dump($book['title']);
        # }

        # Treat results as an Object
        foreach($books as $book) {
            dump($book->title);
        }
    }

    public function practice18()
    {
        # Find book by id
        $results = Book::find(1);

        # Yields a collection of multiple books
        $results = Book::all();
        //$results = Book::orderBy('title')->get();

        # Should match 1 book; yields a Collection of 1 Book
        //$results = Book::where('author', 'F. Scott Fitzgerald')->get();
        //$results = Book::orderBy('title')->first();

        # Should match 0 books; yields an empty Collection
        //$results = Book::where('author', 'Virginia Wolf')->get();

        # Even though we limit it to 1 book, we're using the `get` fetch method so we get a Collection (of 1 Book)
        //$results = Book::limit(1)->get();

        dump($results->toArray());
        // dump($results);
    }

    /**
     * [BONUS]
     * Find any books by the author “J.K. Rowling” and update the author name to be “JK Rowling”.
     */
    public function practice17bonus()
    {
        Book::dump();
        # Approach # 1
        # Get all the books that match the criteria
        /*$books = Book::where('author', '=', 'J.K. Rowling')->get();
        $matches = $books->count();
        dump('Found ' . $matches . ' ' . str_plural('book', $matches) . ' that match this search criteria');
        if ($matches > 0) {
            # Loop through each book and update them
            foreach ($books as $book) {
                $book->author = 'JK Rowling';
                $book->save();
                # Underlying SQL: update `books` set `updated_at` = '20XX-XX-XX XX:XX:XX', `author` = 'JK Rowling' where `id` = '4'
            }
        }*/

        # Approach #2
        # More ideal - Requires 1 query instead of 3
        Book::where('author', '=', 'J.K. Rowling')->update(['author' => 'JK Rowling']);

        Book::dump();
        //Practice::resetDatabase();
    }

    public function practice17()
    # Assignment_11_Practice005 = Remove any/all books by the author “J.K. Rowling”..
    {
        # Show books before delete
        Book::dump();

        $results = Book::where('author', '=', 'J.K. Rowling')->delete();

        #Show books after delete
        Book::dump();

        # To activate for first use, use command composer dump-autoload
        //Practice::resetDatabase();
    }

    public function practice16()
    # Assignment_11_Practice004 = Retrieve all the books in descending order according to published date..
    {
        $results = Book::orderBy('published_year', 'desc')->get();
        dump($results->toArray());
    }

    public function practice15()
    # Assignment_11_Practice003 = Retrieve all the books in alphabetical order by title.
    {
        $results = Book::orderBy('title', 'asc')->get();
        dump($results->toArray());
    }

    public function practice14()
    # Assignment_11_Practice002 = Retrieve all the books published after 1950.
    {
        $results = Book::where('published_year', '>', '1950')->get();
        dump($results->toArray());
    }

    public function practice13()
    # Assignment_11_Practice001 = Retrieve the last 2 books that were added to the books table.
    {
        $results = Book::orderBy('id', 'desc')->limit(2)->get();
        dump($results->toArray());
    }

    public function practice12()
    # Assignment_11_Example = Retrieve all the books authored by J.K Rowling
    {
        $results = Book::where('author', '=', 'J.K. Rowling')->get();
        dump($results->toArray());
    }

    public function practice11()
    // Delete
    {
        # First get a book to delete
        $book = Book::where('author', '=', 'F. Scott Fitzgerald')->first();

        if (!$book) {
            dump('Did not delete- Book not found.');
        } else {
            $book->delete();
            dump('Deletion complete; check the database to see if it worked...');
        }
    }

    public function practice10()
    // Update
    {
        # First get a book to update
        $book = Book::where('author', '=', 'F. Scott Fitzgerald')->first();

        if (!$book) {
            dump("Book not found, can't update.");
        } else {
            # Change some properties
            $book->title = 'The Really Great Gatsby';
            $book->published_year = '2025';

            # Save the changes
            $book->save();

            dump('Update complete; check the database to confirm the update worked.');
        }
    }

    public function practice9()
    // Read (method 2)
    {
        //$book = new Book();
        $books = Book::where('title', 'LIKE', '%Harry Potter%')->get();

        if ($books->isEmpty()) {
            dump('No matches found');
        } else {
            foreach ($books as $book) {
                dump($book->title);
            }
        }
    }

    public function practice8()
    // Read
    {
        $book = new Book();
        $books = $book->where('title', 'LIKE', '%Harry Potter%')->get();

        if ($books->isEmpty()) {
            dump('No matches found');
        } else {
            foreach ($books as $book) {
                dump($book->title);
            }
        }
    }


    public function practice7()
    // Create/Add
    {
        # Instantiate a new Book Model object
        $book = new Book();

        # Set the properties
        # Note how each property corresponds to a field in the table
        // column = value
        $book->title = 'Harry Potter and the Sorcerer\'s Stone';
        $book->author = 'J.K. Rowling';
        $book->published_year = 1997;
        $book->cover_url = 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg';
        $book->purchase_url = 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427';

        # Invoke the Eloquent `save` method to generate a new row in the
        # `books` table, with the above data
        $book->save();

        //dump('Added: '.$book->title);
        dump($book);
    }

    public function practice5()
    {
        $translator = new Parser();
        $translation = $translator->translate('Hello world!');
        dump($translation);
    }

    public function practice4()
    {
        $data = ['foo' => 'bar'];
        Debugbar::info($data);
        Debugbar::info('Current environment: '.App::environment());
        Debugbar::error('Error!');
        Debugbar::warning('Watch out…');
        Debugbar::addMessage('Another message', 'mylabel');

        return 'Demoing some of the features of Debugbar';
    }

    /**
     *
     */
    public function practice3()
    {
        echo Config::get('app.supportEmail');
        echo config('app.supportEmail');
        dump(config('database.connections.mysql'));
    }

    /**
     *
     */
    public function practice2()
    {
        dump(['a' => '123', 'b' => '456']);
    }

    /**
     *
     */
    public function practice1()
    {
        dump('This is the first example.');
    }

    /**
     * ANY (GET/POST/PUT/DELETE)
     * /practice/{n?}
     * This method accepts all requests to /practice/ and
     * invokes the appropriate method.
     * http://foobooks.loc/practice => Shows a listing of all practice routes
     * http://foobooks.loc/practice/1 => Invokes practice1
     * http://foobooks.loc/practice/5 => Invokes practice5
     * http://foobooks.loc/practice/999 => 404 not found
     */
    public function index($n = null)
    {
        $methods = [];

        # If no specific practice is specified, show index of all available methods
        if (is_null($n)) {
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    $methods[] = $method;
                }
            }
            return view('practice')->with(['methods' => $methods]);
        } # Otherwise, load the requested method
        else {
            $method = 'practice' . $n;
            return (method_exists($this, $method)) ? $this->$method() : abort(404);
        }
    }
}