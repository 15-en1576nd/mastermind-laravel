<?php

return [
    // Mastermind game instructions
    'instructions' => <<<'EOT'
        Mastermind is a code-breaking game. The computer has generated a secret code
        consisting of four Emojis. The player must guess the code. The player
        has twelve guesses to do so. Each guess is made up of four Emojis.
        The player is awarded a point for each Emoji in the correct position. The
        player is awarded a point for each Emoji in the correct position and color,
        but not in the correct position. The player loses a point for each Emoji
        in the wrong position. The player loses a point for each Emoji in the wrong
        position and color. The player wins the game if they guess the code within
        twelve guesses.
    EOT
];
