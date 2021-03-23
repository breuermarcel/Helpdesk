@extends('helpdesk::layouts.app')

@section('content')
@if ($chatroom && $currentUser)
    <section class="chat-area">
        <header>
            @if ($currentUser->is_admin)
                <a href="{{ route('helpdesk.admin.dashboard') }}" class="back-icon"><i class="fas fa-arrow-left"></i></a>
            @endif

            @if ($chatroom->owner_id === $currentUser->id)
                @if ($chatroom->member)
                <span>{{ $chatroom->member->firstname }} {{ $chatroom->member->lastname }}</span>
                @else
                <span>{{ trans('Bitte warten...')}}</span>
                @endif
            @else
                <span>{{ $chatroom->owner->firstname }} {{ $chatroom->owner->lastname }}</span>
            @endif

            @if ($currentUser->is_admin)
                <a href="{{ route('helpdesk.chat.resetChat', $chatroom->id) }}" title="{{ trans('Zurücksetzen')}}" class="ms-auto me-1"><i class="fas fa-undo-alt"></i></a>
                <a href="{{ route('helpdesk.chat.archiveChat', $chatroom->id) }}" title="{{ trans('Archivieren')}}" class="archiv-link"><i class="fas fa-archive"></i></a>
            @else
                <a href="{{ route('helpdesk.chat.archiveChat', $chatroom->id) }}" title="{{ trans('Archivieren')}}" class="archiv-link ms-auto"><i class="fas fa-archive"></i></a>
            @endif

        </header>

        <div class="chat-box">

        </div>

        <form action="#" method="POST" class="typing-area">
            @method('POST')
            <input type="hidden" class="owner_id" name="owner_id" value="{{ $currentUser->id }}" />
            <input type="hidden" class="chat_id" name="chat_id" value="{{ $chatroom->id }}" />
            <input type="text" class="input-field" name="message" placeholder="{{ trans('Nachricht eingeben...') }}" autocomplete="off" {{ $chatroom->status === 2 ? 'disabled' : ''}} />
            <button><i class="fab fa-telegram-plane"></i></button>
        </form>
    </section>
@endif
@endsection
