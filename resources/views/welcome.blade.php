@extends('layouts.app')

@section('title', config('app.name') . " - " . __('shorts.instructions'))
@section('description', "MojiMind is a modern take on the classic game of MasterMind with Emojis. Can you break the code in the limited number of turns?")
@section('robots', 'index, follow')

@section('content')
    <h1 class="text-6xl text-gray-800 mx-auto max-w-max my-8">{{config('app.name')}}</h1>
    {{-- Play buttons --}}
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
@endsection
