<div class="bg-white max-w-min mx-auto my-8 grid shadow-xl px-5 py-2">
    <h1 class="text-center text-2xl">Game {{ $game['id'] }}</h1>
    <x-socialmediabuttons :game="$game" />
    @foreach ($game->rows as $row)
        <div class="flex justify-center">
            @foreach ($row->slots as $slot)
                @php
                    // 11 is the max number of rows in the game when 0 is the first row
                    // We subtract turn from 11 to get the row number
                    // We check equality to see if it is the current turn
                    $is_current_turn = 11 - $game['turn'] === $loop->parent->index;
                @endphp
                {{-- Use a form+button for each Emoji slot when it's the current turn so we can use it to
                POST to the game on click. And not spam the DOM with useless elements when not applicable --}}
                @if ($is_current_turn)
                    <form action="{{ route("slots.update", $slot) }}" method="POST" class="m-0">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="value" value="{{$game->selected_emoji}}">
                        <input type="hidden" name="slot" value="{{$loop->index}}">

                        <button
                            class="w-8 h-8 m-1 border rounded bg-gray-400 hover:bg-gray-600"
                            type="submit"
                        >
                            {{-- Show the Emoji corresponding to the current slot --}}
                            {{ $game->emoji_map[$slot->value] }}
                        </button>
                    </form>
                @else
                    <p class="w-8 h-8 m-1 border rounded bg-gray-200 hover:bg-gray-400 cursor-not-allowed">
                        {{-- Show the Emoji corresponding to the current slot --}}
                        {{ $game->emoji_map[$slot->value] }}
                    </p>
                @endif
            @endforeach
            <x-gamehints :slots="$row->slots" />
        </div>
    @endforeach
</div>
