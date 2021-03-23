@extends('helpdesk::layouts.app')

@section('content')
    <section class="register">
        <form action="{{ route('helpdesk.doRegister')}}" method="POST" class="p-4">
            @method('POST')
            @csrf
            <h1>{{ trans('Register')}}</h1>

            <div class="form-group">
                <label for="firstname">{{ trans('Vorname') }}</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname') }}" autocomplete="first-name" autofocus/>
            </div>

            <div class="form-group">
                <label for="lastname">{{ trans('Nachname') }}</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}" autocomplete="family-name"/>
            </div>

            <div class="form-group">
                <label for="email">{{ trans('E-Mail') }}</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" autocomplete="email"/>
            </div>

            <div class="form-group mt-2">
                <button class="btn btn-secondary">{{ trans('Registrieren')}}</button>
            </div>
        </form>
    </section>
@endsection
