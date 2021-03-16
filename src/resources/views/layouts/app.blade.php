<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('helpdesk.name', 'Helpdesk') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" rel="stylesheet"/>
    @include('helpdesk::components.styling')
</head>
<body>
<main class="helpdesk">
    <div class="wrapper">
        @yield('content')
    </div>
</main>
<div id="script-section">
    @include('helpdesk::components.scripts')
</div>
</body>
</html>
