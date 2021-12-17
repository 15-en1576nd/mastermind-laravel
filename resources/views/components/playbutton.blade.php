<form action="{{ route('games.store') }}" method="POST">
    @csrf
    {{-- Difficulty in code_length hidden field --}}
    <input type="hidden" name="code_length" value="{{$difficulty}}">
    {{-- Difficulty in code_length hidden field --}}
    <button
        action="submit"
        @class([
            "text-white font-semibold text-xl py-2 px-4 rounded-md mx-4",
            "bg-green-500 hover:bg-green-700" => $difficulty == 4,
            "bg-blue-500 hover:bg-blue-700" => $difficulty == 5,
            "bg-purple-500 hover:bg-purple-700" => $difficulty == 6
        ])
    >{{strtoupper(__('shorts.play') . " " . __("difficulties.$difficulty"))}}</button>
</form>
