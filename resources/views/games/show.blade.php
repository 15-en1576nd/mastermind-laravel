@extends('layouts.app')

@section('title', "Game #" . $game->id)
@section('description', "Can I guess the " . $game->code_length . " Emoji long code in 12 guesses?")
@section('robots', 'index, nofollow')

@section('content')
@if ($game->won)
<div class="m-auto flex justify-center text-center">
<div class="bg-green-400 text-green-600 mt-4 p-2 max-w-lg rounded-md shadow-lg">
    <h1 class="font-extrabold">You Win!</h1>
    <p>{{ __('shorts.won_description') }} <strong>{{ $game->turn }}</strong> {{ __('shorts.won_description_turn') }}</p>
    <hr>
    <p class="mb-0">
        <a href="/" class="font-bold">{{ __('shorts.play_again') }}</a>
    </p>
</div>
</div>
@elseif ($game->lost)
<div class="m-auto flex justify-center text-center">
<div class="bg-red-300 text-red-600 mt-4 p-2 max-w-lg rounded-md shadow-lg">
    <h1 class="font-extrabold">{{ __('shorts.lost') }}</h1>
    <p>{{ __('shorts.lost_description') }}</p>
    <hr>
    <p class="mb-0">
        <a href="/" class=" font-bold">{{ __('shorts.play_again') }}</a>
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
