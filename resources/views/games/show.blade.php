@extends('layouts.app')

@section('title', "Game #" . $game->id)
@section('description', "Can I guess the " . $game->length . " Emoji long code in 12 guesses?")
@section('robots', 'index, nofollow')

@section('content')
@if ($game->won)
<div class="m-auto flex justify-center text-center">
<div class="bg-green-400 text-green-600 mt-4 p-2 max-w-lg rounded-md shadow-lg">
    <h1 class="font-extrabold">You Win!</h1>
    <p>You guessed the code in <strong>{{ $game->turn }}</strong> guesses.</p>
    <hr>
    <p class="mb-0">
        <a href="{{ route('games.index') }}" class="font-bold">Play Again</a>
    </p>
</div>
</div>
@elseif ($game->lost)
<div class="m-auto flex justify-center text-center">
<div class="bg-red-300 text-red-600 mt-4 p-2 max-w-lg rounded-md shadow-lg">
    <h1 class="font-extrabold">You Lost!</h1>
    <p>You didn't guess the code in 12 guesses.</p>
    <hr>
    <p class="mb-0">
        <a href="{{ route('games.index') }}" class=" font-bold">Play Again</a>
    </p>
</div>
</div>
@endif
    <x-gameboard :game="$game" />
    <x-emojipicker :game="$game" />
    {{-- Submit Button --}}
    <form action="/games/{{ $game->id }}/guess" method="POST" class="max-w-max mx-auto">
        @csrf
        <button type="submit" class="bg-purple-500 rounded text-white text-2xl font-medium p-2">{{ strtoupper(__('shorts.guess')) }}</button>
    </form>
@endsection
