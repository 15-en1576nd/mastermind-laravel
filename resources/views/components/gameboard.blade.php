<div>
    <div class="bg-white max-w-min mx-auto my-8 grid shadow-xl px-5 py-2">
        <h1 class="text-center text-2xl">Game {{ $game['id'] }}</h1>
        @foreach (array_reverse(json_decode($game['board'])) as $row)
            <div class="flex justify-center">
                @foreach ($row as $emoji)
                    {{-- Disable button if $game['turn'] == $loop->index --}}
                    <button class="w-8 h-8 m-1 border rounded hover:bg-gray-400 disabled:opacity-50 {{ 11 - $game['turn'] !== $loop->parent->index ? 'bg-gray-200' : 'bg-gray-300' }}">
                        {{ $emoji }}
                    </button>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
