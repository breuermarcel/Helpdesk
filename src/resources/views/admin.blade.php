@extends('helpdesk::layouts.app')

@section('content')
    <section class="admin p-4">
        <header>
            <h1>{{ trans('Anfragen') }}</h1>
        </header>

        <div class="user-list">
            @if ($chatrooms->count() > 0)
                @foreach ($chatrooms as $chatroom)
                    <div class="chat my-2">
                        <a href="{{ route('helpdesk.admin.joinChat', $chatroom->id) }}">{{ $chatroom->owner->firstname }} {{ $chatroom->owner->lastname }}</a>
                        @if ($chatroom->status === 0)
                            <span class="badge rounded-pill bg-warning text-dark">{{ trans('Wartend') }}</span>
                        @elseif ($chatroom->status === 1)
                            <span class="badge rounded-pill bg-success">{{ trans('In Bearbeitung') }}</span>
                        @else
                            <span class="badge rounded-pill bg-light text-dark">{{ trans('Archiviert') }}</span>
                        @endif
                    </div>
                @endforeach
            @else
                <span>{{ trans('Zurzeit keine Anfragen.') }}</span>
            @endif
        </div>
    </section>

@endsection
