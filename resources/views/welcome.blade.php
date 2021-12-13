<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href=" {{ asset('css/app.css') }} ">
        <script src="{{ asset('js/app.js') }}"></script>
        <title>{{config('app.name')}} - {{__('shorts.instructions')}}</title>
    </head>
    <body class="antialiased">
        <h1 class="text-6xl text-gray-800 mx-auto max-w-max my-8">{{config('app.name')}}</h1>
        <div class="flex justify-around max-w-max mx-auto my-5">
            <a
                href="/game/create?difficulty=easy"
                class="bg-green-500 hover:bg-green-700 text-white font-semibold text-xl py-2 px-4 rounded-md mx-4"
            >{{strtoupper(__('shorts.play'))}} EASY</a>
            <a
                href="/game/create?difficulty=medium"
                class="bg-blue-500 hover:bg-blue-700 text-white font-semibold text-xl py-2 px-4 rounded-md mx-4"
            >{{strtoupper(__('shorts.play'))}} MEDIUM</a>
            <a
                href="/game/create?difficulty=hard"
                class="bg-purple-500 hover:bg-purple-700 text-white font-semibold text-xl py-2 px-4 rounded-md mx-4"
            >{{strtoupper(__('shorts.play'))}} HARD</a>
        </div>
        <x-instructions></x-instructions>
    </body>
</html>
