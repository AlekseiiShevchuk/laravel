<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\book;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('user/index', ['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'firstName' => 'required|alpha', //alpha - поле может содержать только буквы
            'lastName' => 'required|alpha',
            'email' => 'required|email|unique:users',
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return Redirect::to('users/create')
                ->withErrors($validator)
                ->withInput();
        }else{
            $user = new User();
            $user->firstName = $request->firstName;
            $user->lastName = $request->lastName;
            $user->email = $request->email;
            $user->save();

            Session::flash('message', 'Successfully created user');

            return Redirect::to('users');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('user/show',['user'=> $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user/edit',['user'=> $user]);
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
        $user = User::find($id);
        $rules = [
            'firstName' => 'required|alpha', //alpha - поле может содержать только буквы
            'lastName' => 'required|alpha',
            'addBook' => 'exists:books,id,user_id,NULL'
        ];
        // email необходимо валидировать тольков  том случае если он изменился относительно того что был в базе
        // иначе возникнет ошибка НЕуникальности email
        // в то же время просто отключать проверку на уникальность нельзя
        //иначе станет возможным указать НЕуникальный мейл в процессе редактирования профиля пользователя
        if ($user->email != $request->email){
            $rules['email'] = 'required|email|unique:users';
        }

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return Redirect::to('users/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput();
        }else{

            $user->firstName = $request->firstName;
            $user->lastName = $request->lastName;
            $user->email = $request->email;
            $user->save();

            if($request->addBook){
                $book = Book::find($request->addBook);
                //$book->user_id = $id;
                //$book->save();
                $user->books()->save($book); //eloquent style binding
                Session::flash('message', 'Book added successfully, user updated');
            }else{
                Session::flash('message', 'Successfully updated user');
            }



            return Redirect::to('users/'. $id);
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
        $user = User::find($id);
        $user->delete();
        Session::flash('message', 'User Successfully deleted');
        return Redirect::to('users');
    }
}
