<ul class="media-list">
@foreach ($photoposts as $photopost)
    <?php $user = $photopost->user; ?>
    <li class="media">
        <div class="media-left">
            <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
        </div>
        <div class="media-body">
            <div>
                {!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!} <span class="text-muted">posted at {{ $photopost->created_at }}</span>
            </div>
            <div>
                <p>{!! nl2br(e($photopost->content)) !!}</p>
            </div>
            <div>
                @if (Auth::id() == $photopost->user_id)
                    {!! Form::open(['route' => ['photoposts.destroy', $photopost->id], 'method' => 'delete']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </li>
@endforeach
</ul>
{!! $photoposts->render() !!}