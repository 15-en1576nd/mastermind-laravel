<div>
    <div class="bg-white max-w-min mx-auto my-8 grid shadow-xl px-5 py-2">
        <h1 class="text-center text-2xl">Game {{ $game['id'] }}</h1>
        <x-socialmediabuttons :game="$game" />
        @foreach (array_reverse(json_decode($game['board'])) as $row)
            <div class="flex justify-center">
                @foreach ($row as $emoji_id)
                    {{-- Disable button if $game['turn'] == $loop->index --}}
                    <form action="/game/{{$game->id}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="emoji_id" value="{{app('App\Http\Controllers\SelectedEmojiController')->index()["emoji_id"]}}">
                        <input type="hidden" name="slot" value="{{$loop->index}}">
                        <button
                            class="w-8 h-8 m-1 border rounded {{ 11 - $game['turn'] !== $loop->parent->index ? 'bg-gray-200 hover:bg-gray-400 cursor-not-allowed' : 'bg-gray-400 hover:bg-gray-600' }}"
                            type="submit"
                            {{ 11 - $game['turn'] !== $loop->parent->index ? 'disabled' : '' }}
                        >
                            {{app('App\Http\Controllers\SelectedEmojiController')->getEmoji($emoji_id)["emoji"]}}
                        </button>
                    </form>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
