@extends('layouts.app')

@section('title', __('shorts.login'))
@section('description', "Login to keep track of your games and compete with your friends on the leaderboard.")
@section('robots', 'index, follow')

@section('content')
    <div class="bg-white py-5 px-3 max-w-xl mx-auto m-5">
        <h2 class="mb-3 font-semibold text-3xl text-gray-800">{{ __('shorts.login') }}</h2>
        <form method="POST" action="/login" class="w-full">
            @csrf

            <div class="mb-3">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">{{ __('shorts.email') }}</label>
                <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">{{ __('shorts.password') }}</label>
                <input id="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror
                " name="password" required autocomplete="new-password">
                <p class="text-gray-600 text-xs italic">{{ __('shorts.password_description') }}</p>
                <p class="text-gray-600 text-xs italic">{{ __('shorts.password_requirements') }}</p>
            </div>
            <div class="flex justify-around w-full">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline max-w-max">
                    {{ __('shorts.register') }}
                </button>
            </div>
        </form>

    </div>
@endsection
