@extends('layouts.app')

@section('title', "Game #" . $game->id)
@section('description', "Can I guess the " . $game->length . " Emoji long code in 12 guesses?")
@section('robots', 'index, nofollow')

@section('content')
    <x-gameboard :game="$game" />
    <x-emojipicker :game="$game" />
    {{-- Submit Button --}}
    <form action="{{ route('games.update', $game) }}" method="POST" class="max-w-max mx-auto">
        @csrf
        @method('PUT')
        <button type="submit" class="bg-purple-500 rounded text-white text-2xl font-medium p-2">{{ strtoupper(__('shorts.guess')) }}</button>
    </form>
    <x-scoreboard :game="$game" />
@endsection