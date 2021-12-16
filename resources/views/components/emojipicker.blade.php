<div class="flex bg-white max-w-max justify-center mx-auto p-1 mb-4 shadow-xl">
    @php
        $emoji_map = $game->emoji_map;
        // Shift the Emoji Map to the left by one so that the invisible first element is removed.
        array_shift($emoji_map);
    @endphp


    @foreach($emoji_map as $emoji)
        <form action="{{ route("games.update", $game) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="selected_emoji" value="{{$loop->index+1}}">
            <button
                @class([
                    "w-8 h-8 m-1 border rounded",
                    "bg-gray-200 hover:bg-gray-400" => $game->selected_emoji != $loop->index+1,
                    "bg-gray-400 hover:bg-gray-600" => $game->selected_emoji == $loop->index+1,
                ])
                type="submit"
            >
                {{ $emoji }}
            </button>
        </form>
    @endforeach
</div>
