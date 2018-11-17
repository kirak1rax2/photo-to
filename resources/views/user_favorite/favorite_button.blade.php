@if (Auth::id() != $photopost->user_id)
    @if (Auth::user()->isFavorite($photopost->id))
        {!! Form::open(['route' => ['user.unfavorite', $photopost->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unfavorite', ['class' => "btn btn-danger"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['user.favorite', $photopost->id]]) !!}
            {!! Form::submit('Favorite', ['class' => "btn btn-primary"]) !!}
        {!! Form::close() !!}
    @endif
@endif