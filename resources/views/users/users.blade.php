@if (count($users) > 0)
<ul class="media-list">
    
@foreach ($users as $user)

    <li class="media">
        <aside class="col-xs-6">
        <div class="media-left">
          <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
        </div>
        <div class="media-body">
            <div>
              {{ $user->name }}
            </div>
            <div>
                <p>{!! link_to_route('users.show', 'View Profile?', ['id' => $user->id]) !!}</p>
            </div>
        </div>
        </aside>
    </li>
    
@endforeach
</ul>
{!! $users->render() !!}
@endif

