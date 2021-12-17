<div class="sticky h-16 bg-white shadow-md border-t-4 border-blue-700">
    {{-- Show username if logged in --}}
    @if (Auth::check())
        <div class="flex justify-between items-center px-4 py-2">
            {{-- Show username --}}
            <p class="text-blue-700 text-lg">
                {{ Auth::user()->name }}
            </p>
        </div>
    @endif
    <div class="h-full float-right flex items-center justify-center">
        <a class="h-full" href={{ __('shorts.changelang') }}>
            <img src={{ __('shorts.langimg') }} class="h-full p-3">
        </a>
    </div>
</div>
