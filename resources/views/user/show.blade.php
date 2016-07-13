@extends('app')

@section('pagetitle')
    User CARD
@stop


@section('content')

    <table class="table table-bordered">
        <tbody>

            <tr><th>ID:</th><td>{{$user->id}}</td></tr>
            <tr><th>FirstName</th><td>{{$user->firstName}}</td></tr>
            <tr><th>LastName</th><td>{{$user->lastName}}</td></tr>
            <tr><th>E-Mail</th><td>{{$user->email}}</td></tr>
            <tr><th>Books that the user has gotten:</th>
                <td>
                    @if(count($user->books) == 0)
                        This user does not have any books
                    @endif
                    <ul>
                        @foreach($user->books as $book)
                            <li>{{$book->title}}</li>
                            @if($book)
                                {!! Form::open(['url'=>'books/'. $book->id , 'class'=>'']) !!}
                                {!! Form::hidden('_method', 'PATCH') !!}
                                {!! Form::hidden('_action', 'giveback') !!}
                                {!! Form::submit('Give back', ['class'=> 'btn-small btn-warning']) !!}
                                {!! Form::close() !!}
                            @endif
                        @endforeach
                    </ul>
                </td></tr>
            <tr>
                <th>Control Buttons:</th>
                <td>
                    <a class="btn btn-small btn-success pull-left" href="{{URL::to('users/' . $user->id . '/edit')}}">Edit this user</a>
                    {!! Form::open(['url'=>'users/'. $user->id, 'class'=>'pull-left']) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::submit('Delete this User', ['class'=> 'btn btn-danger']) !!}
                    {!! Form::close() !!}



                </td></tr>



        </tbody>
    </table>

@stop

