@extends('layouts.app')

@section('title', __('shorts.instructions'))
@section('description', "MojiMind is a modern take on the classic game of MasterMind with Emojis. Can you break the code in the limited number of turns?")
{{-- Don't want robots to follow links because that would result in DB
getting spammed for no reason. (GET /game/create?difficulty= * 3) --}}
@section('robots', 'index, nofollow')

@section('content')
    <img src="/logo.webp" class="max-w-xl mx-auto" alt="mojimind">
    {{-- Play buttons --}}
    <div class="flex justify-around max-w-max mx-auto my-5">
        <x-playbutton :difficulty="4" />
        <x-playbutton :difficulty="5" />
        <x-playbutton :difficulty="6" />
    </div>
    <x-instructions></x-instructions>
    <div class="flex justify-center">
        <a
            href="{{route('scoreboard.index')}}"
            class="text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md my-5"
        >{{strtoupper(__('shorts.scoreboard'))}}</a>
    </div>
@endsection
