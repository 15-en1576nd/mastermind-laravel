<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href=" {{ asset('css/app.css') }} ">
    <script src="{{ asset('js/app.js') }}"></script>
    <link href="https://pro.fontawesome.com/releases/v5.13.1/css/all.css" rel="stylesheet">
    <title>{{ config('app.name') }} - game</title>
    <meta name="description" content="Can I guess the {{ $game->length }} Emoji long code in 12 guesses?">
    <meta name="robots" content="noindex, nofollow">
</head>

<body>
    <x-gameboard :game="$game" />
    <x-emojipicker />
    {{-- Submit Button --}}
    <form action={{ "/game/" . $game->id . "/guess"}}
        method="POST"
        class="mx-auto max-w-max bg-purple-500 rounded text-white text-2xl font-medium p-2">
        @csrf
        <button type="submit">{{ strtoupper(__('shorts.guess')) }}</button>
    </form>
    <x-scoreboard :game="$game" />
</body>
