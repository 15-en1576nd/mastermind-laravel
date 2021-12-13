<a
    href="/game/create?difficulty={{$difficulty}}"
    @class([
        "text-white font-semibold text-xl py-2 px-4 rounded-md mx-4",
        "bg-green-500 hover:bg-green-700" => $difficulty == "easy",
        "bg-blue-500 hover:bg-blue-700" => $difficulty == "medium",
        "bg-purple-500 hover:bg-purple-700" => $difficulty == "hard"
    ])
>{{strtoupper(__('shorts.play') . " " . $difficulty)}}</a>
