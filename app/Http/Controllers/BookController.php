<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\BookDetail;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('book.index', [
            'books' => Book::with('category')->orderBy('name', 'ASC')->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create', [
            'categories' => Category::pluck('id', 'name')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $descriptionReq = count(request('description'));
        DB::beginTransaction();
        try {
            $book = Book::create($request->except('description'));
            for($a = 0; $a < $descriptionReq; $a++)
            {
                BookDetail::create([
                    'book_id' => $book->id,
                    'description' => request('description')[$a]
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed ' . $e->getMessage());
        }
        return back()->with('success', 'Book Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('book.edit', [
            'book' => $book,
            'categories' => Category::pluck('id', 'name')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, Book $book)
    {
        $book->delete();
        $descriptionReq = count(request('description'));
        $attribute = $request->except('description');
        $attribute['id'] = $book->id;
        DB::beginTransaction();
        try {
            Book::create($attribute);
            for($a = 0; $a < $descriptionReq; $a++)
            {
                BookDetail::create([
                    'book_id' => $book->id,
                    'description' => request('description')[$a]
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed ' . $e->getMessage());
        }
        return back()->with('success', 'Book Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        try {
            $book->delete();
        } catch (\Exception $e) {
            return back()->with('error', 'Failed ' . $e->getMessage());
        }
        return back()->with('success', 'Book Has Been deleted!');
    }
}
