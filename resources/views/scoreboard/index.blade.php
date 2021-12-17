@extends('layouts.app')

@section('title', "Scoreboard")
@section('description', "View the top scores of all MojiMind games.")
@section('robots', 'index, follow')

@section('content')
    <div class="w-full p-10">
        <x-scoreboard :games="$games" />
    </div>
    <div class="flex justify-center">
        <a href="/" class="bg-blue-500 hover:bg-blue-700 mx-auto max-w-max text-white font-bold py-2 px-4 rounded-md">
            {{ strtoupper(__('shorts.playyourself')) }}
        </a>
    </div>
@endsection
