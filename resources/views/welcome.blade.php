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
        <x-playbutton difficulty="easy" />
        <x-playbutton difficulty="medium" />
        <x-playbutton difficulty="hard" />
    </div>
    <x-instructions></x-instructions>
@endsection
