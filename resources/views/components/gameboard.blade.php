<div class="bg-white max-w-min mx-auto my-8 grid shadow-xl px-5 py-2">
    <h1 class="text-center text-2xl">Game {{ $game['id'] }}</h1>
    <x-socialmediabuttons :game="$game" />

    @php
        $board = json_decode($game['board']);
        // array_reverse is used so when ran in a for each loop, the first item in the array is the last row of the game
        $reversed_board = array_reverse($board);
    @endphp

    @php
        $emoji_controller = app('App\Http\Controllers\SelectedEmojiController');
        $selected_emoji_id = $emoji_controller->index()["emoji_id"];
    @endphp

    @foreach ($reversed_board as $row)
        <div class="flex justify-center">
            @foreach ($row as $emoji_id)
                @php
                    // 11 is the max number of rows in the game when 0 is the first row
                    // We subtract turn from 11 to get the row number
                    // We check equality to see if it is the current turn
                    $is_current_turn = 11 - $game['turn'] === $loop->parent->index;
                @endphp
                {{-- Use a form+button for each Emoji slot when it's the current turn so we can use it to
                POST to the game on click. And not spam the DOM with useless elements when not applicable --}}
                @if ($is_current_turn)
                    <form action="/game/{{$game->id}}" method="POST" class="m-0">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="emoji_id" value="{{$selected_emoji_id}}">
                        <input type="hidden" name="slot" value="{{$loop->index}}">

                        <button
                            class="w-8 h-8 m-1 border rounded bg-gray-400 hover:bg-gray-600"
                            type="submit"
                        >
                            {{-- Show the Emoji corresponding to the current slot --}}
                            {{$emoji_controller->getEmoji($emoji_id)["emoji"]}}
                        </button>
                    </form>
                @else
                    <p class="w-8 h-8 m-1 border rounded bg-gray-200 hover:bg-gray-400 cursor-not-allowed">
                        {{-- Show the Emoji corresponding to the current slot --}}
                        {{$emoji_controller->getEmoji($emoji_id)["emoji"]}}
                    </p>
                @endif
            @endforeach
        </div>
    @endforeach
</div>
