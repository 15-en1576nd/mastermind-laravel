<div class="sticky h-16 bg-white shadow-md border-t-4 border-blue-700">
    {{-- Show username if logged in --}}
    <div class="h-full w-full flex justify-between items-center">
        <a href="/" class="text-blue-700 hover:text-blue-600">
            <img src="/logo.webp" class="h-full ml-2" alt="mojimind">
        </a>
        <div class="flex h-full justify-center items-center">
            @if (Auth::check())
                <form action="/logout" method="POST" class="m-0">
                    @csrf
                    <button action="submit" class="p-2">
                        <span class="text-blue-700 text-lg font-semibold" title="{{ __('shorts.logout') }}">
                            {{ __('shorts.welcome') }}, {{ Auth::user()->name }}
                        </span>
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
</div>
