@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-xs-offset-3 col-xs-6">

            {!! Form::open(['route' => 'login.post']) !!}
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                <div class="text-center">
                        {!! Form::submit('ログイン', ['class' => 'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}

            <p>New user? {!! link_to_route('signup.get', 'Sign up now!') !!}</p>
        </div>
    </div>
@endsection