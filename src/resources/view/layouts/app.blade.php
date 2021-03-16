<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('helpdesk.name', 'Helpdesk') }}</title>
    <link href="{{ asset('css/helpdesk.css') }}" rel="stylesheet">
</head>
<body>
<main class="helpdesk">
    @yield('content')
</main>
<div id="script-section">
    <script src="{{ asset('js/helpdesk.js') }}"></script>
</div>
</body>
</html>
