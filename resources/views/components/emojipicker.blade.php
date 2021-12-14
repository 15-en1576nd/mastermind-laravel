<div class="flex bg-white max-w-max justify-center mx-auto p-1 mb-4 shadow-xl">
    @php
        $emoji_controller = app('App\Http\Controllers\SelectedEmojiController');
        $selected_emoji_id = $emoji_controller->getSelectedEmojiId();
        $emoji_map = $emoji_controller->getEmojiMap();
        // Shift the Emoji Map to the left by one so that the invisible first element is removed.
        array_shift($emoji_map);
    @endphp


    @foreach($emoji_map as $emoji)
        <form action="/selected-emoji" method="POST">
            @csrf
            <input type="hidden" name="emoji_id" value="{{$loop->index+1}}">
            <button
                @class([
                    "w-8 h-8 m-1 border rounded",
                    "bg-gray-200 hover:bg-gray-400" => $selected_emoji_id != $loop->index+1,
                    "bg-gray-400 hover:bg-gray-600" => $selected_emoji_id == $loop->index+1,
                ])
                type="submit"
            >
                {{ $emoji }}
            </button>
        </form>
    @endforeach
</div>
