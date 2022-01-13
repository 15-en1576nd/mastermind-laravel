{{-- 2 by ?? grid of hints --}}
<div class="grid grid-cols-2 grid-rows-{{round(count($hints) / 2)}} w-8 h-8 m-1 rounded overflow-hidden bg-gray-200">
    @php
        // We have to create a copy, then sort it. Because PHP is stupid.
        $sorted_hints = $hints;
        rsort($sorted_hints);
    @endphp
    @foreach ($sorted_hints as $hint)
        {{-- A hint is either EMPTY(0), EXACT(1) or NEAR(2) --}}
        <div
            @class([
                "h-0 h-0 p-2 m-0 inline border border-gray-300",
                // No hint
                "bg-gray-200" => $hint == 0,
                // Exact
                "bg-green-200" => $hint == 1,
                // Near
                "bg-yellow-200" => $hint == 2,
            ])
        ></div>
    @endforeach
</div>
