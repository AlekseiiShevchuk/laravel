@extends('app')

@section('pagetitle')
    User List
@stop


@section('content')

        <table class="table table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>firstName</td>
            <td>lastName</td>
            <td>email</td>
            <td>Books that the user has gotten</td>
            <td>Control Buttons</td>

        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->firstName}}</td>
            <td>{{$user->lastName}}</td>
            <td>{{$user->email}}</td>
            <td>
                @if(count($user->books) == 0)
                    This user does not have any books
                @endif

                <ul>
            @foreach($user->books as $book)
                <li>{{$book->title}}</li>

                        {!! Form::open(['url'=>'books/'. $book->id , 'class'=>'']) !!}
                        {!! Form::hidden('_method', 'PATCH') !!}
                        {!! Form::hidden('_action', 'giveback') !!}
                        {!! Form::submit('Give back', ['class'=> 'btn-small btn-warning']) !!}
                        {!! Form::close() !!}

            @endforeach
                </ul>
            </td>
            <td width="380px">
                <a class="btn btn-small btn-success" href="{{URL::to('users/' . $user->id)}}">Show this user</a>
                <a class="btn btn-small btn-success" href="{{URL::to('users/' . $user->id . '/edit')}}">Edit this user</a>

                {!! Form::open(['url'=>'users/'. $user->id, 'class'=>'pull-right']) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::submit('Delete this User', ['class'=> 'btn btn-warning']) !!}
                {!! Form::close() !!}
            </td>
        </tr>

        @endforeach
        </tbody>
    </table>
    {!! $users->render() !!}

@stop

