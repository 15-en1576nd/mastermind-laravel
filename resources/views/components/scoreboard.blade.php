<div>
    {{-- Dump $scoreboard as json --}}
    <pre>{{ json_encode(app('App\Http\Controllers\ScoreboardController')->getScoreboard($game->length)) }}</pre>
</div>
