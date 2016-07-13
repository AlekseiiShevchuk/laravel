@extends('app')

@section('pagetitle')
    Book CARD
@stop


@section('content')

    <table class="table table-bordered">
        <tbody>

            <tr><th>Book ID:</th><td>{{$book->id}}</td></tr>
            <tr><th>Book Title</th><td>{{$book->title}}</td></tr>
            <tr><th>Book Author</th><td>{{$book->author}}</td></tr>
            <tr><th>Year of publishing</th><td>{{$book->year}}</td></tr>
            <tr><th>Genre of the Book</th><td>{{$book->genre}}</td></tr>
            <tr>
                <th>User who has gotten the book:</th>
                <td>
                    @if ($book->user)
                        <a href="{{URL::to('users/' . $book->user->id)}}">{{$book->user->firstName}} {{$book->user->lastName}}</a>
                    @else
                        Book is FREE
                    @endif
                </td>
            </tr>
            <tr>
                <th>Control Buttons:</th>
                <td>
                    <a class="btn btn-small btn-success pull-left" href="{{URL::to('books/' . $book->id . '/edit')}}">Edit this book</a>
                    {!! Form::open(['url'=>'books/'. $book->id, 'class'=>'pull-left']) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::submit('Delete this Book', ['class'=> 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td></tr>



        </tbody>
    </table>

@stop

