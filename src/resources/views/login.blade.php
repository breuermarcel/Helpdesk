@extends('helpdesk::layouts.app')

@section('content')
    <section class="login">
        <form action="{{ route('helpdesk.doLogin')}}" method="POST" class="p-4">
            @method('POST')
            @csrf
            <h1>{{ trans('Login')}}</h1>

            <div class="form-group">
                <label for="email">{{ trans('E-Mail') }}</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus/>
            </div>

            <div class="form-group">
                <label for="password">{{ trans('Passwort') }}</label>
                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" autocomplete="password"/>
            </div>

            <div class="form-group mt-2">
                <button class="btn btn-secondary">{{ trans('Anmelden')}}</button>
            </div>
        </form>
    </section>
@endsection
