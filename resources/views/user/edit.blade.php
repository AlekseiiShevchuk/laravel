@extends('app')

@section('pagetitle')
    Edit User
@stop


@section('content')

    {!! Html::ul($errors->all()) !!}

    {!! Form::model($user, ['route'=>['users.update',$user->id], 'method'=> 'PUT']) !!}
    <div class="form-group">
        {!! Form::label('firstName', 'FirstName') !!}
        {!! Form::text('firstName', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('lastName', 'LastName') !!}
        {!! Form::text('lastName', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'E-Mail') !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('addBook', 'Type Book ID you want to give to user (the book must be free)') !!}
        {!! Form::text('addBook', null, ['class' => 'form-control']) !!}
    </div>
    {!! Form::submit('Update User',['class' =>'btn btn-primary']) !!}
    {!! Form::close() !!}

@stop