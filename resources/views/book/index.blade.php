@extends('app')

@section('pagetitle')
    Book List
@stop


@section('content')

        <table class="table table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>Title</td>
            <td>Autor</td>
            <td>Year</td>
            <td>Genre</td>
            <td>User who has gotten the book</td>
            <td>Control Buttons</td>

        </tr>
        </thead>
        <tbody>
        @foreach($books as $book)
        <tr>
            <td>{{$book->id}}</td>
            <td>{{$book->title}}</td>
            <td>{{$book->author}}</td>
            <td>{{$book->year}}</td>
            <td>{{$book->genre}}</td>
            <td>
                @if ($book->user)
                <a href="{{URL::to('users/' . $book->user->id)}}">{{$book->user->firstName}} {{$book->user->lastName}}</a>
                @else
                Book is FREE
                @endif

            </td>
            <td width="380px">
                <a class="btn btn-small btn-success pull-left" href="{{URL::to('books/' . $book->id)}}">Show this book</a>
                <a class="btn btn-small btn-success pull-left" href="{{URL::to('books/' . $book->id . '/edit')}}">Edit this book</a>

                {!! Form::open(['url'=>'books/'. $book->id, 'class'=>'pull-left']) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::submit('Delete this BOOK', ['class'=> 'btn btn-danger']) !!}
                {!! Form::close() !!}

                @if($book->user_id)
                    {!! Form::open(['url'=>'books/'. $book->id , 'class'=>'pull-left']) !!}
                    {!! Form::hidden('_method', 'PATCH') !!}
                    {!! Form::hidden('_action', 'giveback') !!}
                    {!! Form::submit('Give back the book', ['class'=> 'btn btn-warning']) !!}
                    {!! Form::close() !!}
                @endif
            </td>
        </tr>

        @endforeach
        </tbody>
    </table>
    {!! $books->render() !!}

@stop

