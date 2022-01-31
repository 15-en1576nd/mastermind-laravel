<div class="flex flex-col bg-white rounded-xl px-3 py-5 max-w-3xl w-full mx-auto shadow-xl">
    <table class="text-left">
        <thead class="text-gray-900 font-semibold">
            <tr>
                <th>
                    Rank
                </th>
                <th>
                    {{ __('shorts.difficulty') }}
                <th>
                    Score
                </th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @foreach($games as $game)
                <x-scoreboard-entry
                    :score="$game->score"
                    :id="$game->id"
                    :difficulty="__('difficulties.' . $game->code_length)"
                    :rank="$loop->iteration" />
            @endforeach
        </tbody>
    </table>
</div>
