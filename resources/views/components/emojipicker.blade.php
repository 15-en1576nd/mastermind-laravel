<div class="flex bg-white max-w-max justify-center mx-auto p-1 mb-4 shadow-xl">
    @php
        $emoji_map = app('App\Http\Controllers\SelectedEmojiController')->getEmojiMap();
        array_shift($emoji_map);
    @endphp

    @php
        $emoji_controller = app('App\Http\Controllers\SelectedEmojiController');
        $selected_emoji = $emoji_controller->index()['emoji_id'];
    @endphp


    @foreach($emoji_map as $emoji)
        <form action="/selected-emoji" method="POST">
            @csrf
            <input type="hidden" name="emoji_id" value="{{$loop->index+1}}">
            <button
                @class([
                    "w-8 h-8 m-1 border rounded",
                    "bg-gray-200 hover:bg-gray-400" => $selected_emoji != $loop->index+1,
                    "bg-gray-400 hover:bg-gray-600" => $selected_emoji == $loop->index+1,
                ])
                type="submit"
            >
                {{ $emoji }}
            </button>
        </form>
    @endforeach
</div>
