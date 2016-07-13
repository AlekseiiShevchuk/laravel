@extends('app')

@section('pagetitle')
    Edit book
@stop


@section('content')

    {!! Html::ul($errors->all()) !!}

    {!! Form::model($book, ['route'=>['books.update',$book->id], 'method'=> 'PUT']) !!}

    <div class="form-group">
        {!! Form::label('title', 'Book Title') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('author', 'Book Author') !!}
        {!! Form::text('author', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('year', 'Year of publishing') !!}
        {!! Form::text('year', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('genre', 'Genre of the Book') !!}
        {!! Form::text('genre', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('user_id', 'ID of user who has gotten the book') !!}
        {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
    </div>

    {!! Form::hidden('_action', 'edit') !!}
    {!! Form::submit('Update Book',['class' =>'btn btn-primary']) !!}

    {!! Form::close() !!}

    @if($book->user_id)
    {!! Form::open(['url'=>'books/'. $book->id , 'class'=>'pull-left']) !!}
    {!! Form::hidden('_method', 'PATCH') !!}
    {!! Form::hidden('_action', 'giveback') !!}
    {!! Form::submit('Give back the book', ['class'=> 'btn btn-warning']) !!}
    {!! Form::close() !!}
    @endif

@stop