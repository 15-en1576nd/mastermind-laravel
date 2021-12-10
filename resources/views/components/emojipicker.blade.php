<div class="flex bg-white max-w-max justify-center mx-auto p-1 mb-4 shadow-xl">
    @foreach(
        // Inline function because have to slice of the first element
        // This would've been a lot cleaner if the stupid props would work
        (function() {
            $emoji_map = app('App\Http\Controllers\SelectedEmojiController')->getEmojiMap();
            $first_element = array_shift($emoji_map);
            return $emoji_map;
            })() as $emoji)
        <form action="/selected-emoji" method="POST">
            @csrf
            <input type="hidden" name="emoji_id" value="{{$loop->index+1}}">
            <button
                class="w-8 h-8 m-1 border rounded {{ (app('App\Http\Controllers\SelectedEmojiController')->index()['emoji_id']-1) != $loop->index ? 'bg-gray-200 hover:bg-gray-400' : 'bg-gray-400 hover:bg-gray-600' }}"
                type="submit"
            >
                {{ $emoji }}
            </button>
        </form>
    @endforeach
</div>
