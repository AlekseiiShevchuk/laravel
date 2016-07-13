<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Book;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::paginate(10);

        return view('book/index', ['books'=>$books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        return view('book.show', ['book'=> $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        return view('book/edit',['book'=> $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if($request['_action']=='giveback'){
            $book->user_id = null;
            $book->save();
            Session::flash('message', 'Book with ID:' .$book->id. ' has given back successfully');
            return Redirect::to('books');
        }

        if($request['_action']=='edit'){

            $rules = [
                'title' => 'required',
                'year' => 'required|digits:4',
                'author' => 'required|alpha',
                'user_id' => 'exists:users,id',
                'genre' => 'required|alpha' //alpha - поле может содержать только буквы
            ];

            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                return Redirect::to('books/'.$id.'/edit')
                    ->withErrors($validator)
                    ->withInput();
            }else {

                $book->title = $request->title;
                $book->year = $request->year;
                $book->author = $request->author;
                $book->genre = $request->genre;
                $book->user_id = $request->user_id;
                $book->save();
                Session::flash('message', 'Book with ID:' . $book->id . ' successfully updated');
                return Redirect::to('books');
            }
        }
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
        $book->delete();
        Session::flash('message', 'Book with ID:' .$book->id. ' Successfully deleted');
        return Redirect::to('books');
    }


}
