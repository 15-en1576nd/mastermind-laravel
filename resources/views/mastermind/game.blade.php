@extends('layouts.app')

@section('title', "Game #" . $game->id)
@section('description', "Can I guess the " . $game->length . " Emoji long code in 12 guesses?")
@section('robots', 'index, nofollow')

@section('content')
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
@endsection
