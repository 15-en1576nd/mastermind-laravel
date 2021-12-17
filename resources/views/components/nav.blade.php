<div class="sticky h-16 bg-white shadow-md border-t-4 border-blue-700">
    {{-- Show username if logged in --}}
    <div class="h-full float-right flex justify-end items-center">
        @if (Auth::check())
            <form action="/logout" method="POST">
                @csrf
                <button action="submit" class="p-2">
                    <p class="text-blue-700 text-lg font-semibold">
                        {{ __('shorts.welcome') }}, {{ Auth::user()->name }}
                    </p>
                </button>
            </form>
        @else
            <a href="/login" class="p-2">
                <p class="text-blue-700 text-lg font-semibold">
                    {{ __('shorts.login') }}
                </p>
            </a>
        @endif
        <a class="h-full" href={{ __('shorts.changelang') }}>
            <img src={{ __('shorts.langimg') }} class="h-full p-3">
        </a>
    </div>
</div>
