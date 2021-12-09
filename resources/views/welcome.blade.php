<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href=" {{ asset('css/app.css') }} ">
        <script src="{{ asset('js/app.js') }}"></script>
        <title>{{config('app.name')}} - {{__('shorts.instructions')}}</title>
    </head>
    <body class="antialiased bg-green-300">
        <x-instructions></x-instructions>
    </body>
</html>
