@extends('app')

@section('pagetitle')
   Create BOOK
@stop


@section('content')

   {!! Html::ul($errors->all()) !!}

   {!! Form::open(['url'=>'books']) !!}

   <div class="form-group">
      {!! Form::label('title', 'Book Title') !!}
      {!! Form::text('title', Input::old('title'), ['class' => 'form-control']) !!}
   </div>
   <div class="form-group">
      {!! Form::label('author', 'Book Author') !!}
      {!! Form::text('author', Input::old('author'), ['class' => 'form-control']) !!}
   </div>
   <div class="form-group">
      {!! Form::label('year', 'Year of publishing') !!}
      {!! Form::text('year', Input::old('year'), ['class' => 'form-control']) !!}
   </div>
   <div class="form-group">
      {!! Form::label('genre', 'Genre of the Book') !!}
      {!! Form::text('genre', Input::old('genre'), ['class' => 'form-control']) !!}
   </div>
   <div class="form-group">
      {!! Form::label('user_id', 'ID of user who has gotten the book') !!}
      {!! Form::text('user_id', Input::old('user_id'), ['class' => 'form-control']) !!}
   </div>

    {!! Form::submit('Create Book',['class' =>'btn btn-primary']) !!}

   {!! Form::close() !!}


@stop