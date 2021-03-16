@extends('helpdesk::layouts.app')

@section('content')
    <section class="chat-area">
        <header>
            {{-- if user is admin show backlink--}}
            <a href="#" class="back-icon"><i class="fas fa-arrow-left"></i></a>
            {{-- endif --}}
            <div class="details">
                <span>Max Mustermann</span>
            </div>
        </header>
        <div class="chat-box">

        </div>
        <form action="#" method="POST" class="typing-area">
            @method('POST')
            <input type="hidden" class="owner_id" name="owner_id" value="1" />
            <input type="hidden" class="chat_id" name="chat_id" value="1" />
            <input type="text" class="input-field" name="message" placeholder="{{ trans('Type a message here...')  }}" autocomplete="off" />
            <button><i class="fab fa-telegram-plane"></i></button>
        </form>
    </section>
@endsection
