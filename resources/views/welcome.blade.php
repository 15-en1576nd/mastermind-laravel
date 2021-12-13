@extends('layouts.app')

@section('title', config('app.name') . " - " . __('shorts.instructions'))
@section('description', "MojiMind is a modern take on the classic game of MasterMind with Emojis. Can you break the code in the limited number of turns?")
@section('robots', 'index, follow')

@section('content')
    <h1 class="text-6xl text-gray-800 mx-auto max-w-max my-8">{{config('app.name')}}</h1>
    {{-- Play buttons --}}
    <div class="flex justify-around max-w-max mx-auto my-5">
        <x-playbutton difficulty="easy" />
        <x-playbutton difficulty="medium" />
        <x-playbutton difficulty="hard" />
    </div>
    <x-instructions></x-instructions>
@endsection
