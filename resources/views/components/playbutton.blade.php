<form action="{{ route('games.store') }}" method="POST">
    @csrf
    {{-- Difficulty in code_length hidden field --}}
    <input type="hidden" name="code_length" value="{{
        // if the user has selected a difficulty, use that
        // otherwise, use the default difficulty of 4.
        $difficulty == 'easy' ? '4' :
        ($difficulty == 'medium' ? '5' :
        ($difficulty == 'hard' ? '6' :
        '4'))
    }}">
    {{-- Difficulty in code_length hidden field --}}
    <button
        action="submit"
        @class([
            "text-white font-semibold text-xl py-2 px-4 rounded-md mx-4",
            "bg-green-500 hover:bg-green-700" => $difficulty == "easy",
            "bg-blue-500 hover:bg-blue-700" => $difficulty == "medium",
            "bg-purple-500 hover:bg-purple-700" => $difficulty == "hard"
        ])
    >{{strtoupper(__('shorts.play') . " " . $difficulty)}}</button>
</form>
