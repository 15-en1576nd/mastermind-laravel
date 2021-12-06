<?php

return [
    // Mastermind game instructions
    'instructions' => <<<'EOT'
        Mastermind is een code-brekend spel. De computer heeft een geheime code gegenereerd
        bestaande uit vier gekleurde pinnen. De speler moet de code raden. De speler
        heeft daarvoor twaalf keer raden. Elke gok bestaat uit vier gekleurde pinnen.
        De speler krijgt een punt voor elke pin in de juiste positie. De
        speler krijgt een punt voor elke peg in de juiste positie en kleur,
        maar niet op de juiste plaats. De speler verliest een punt voor elke peg
        op de verkeerde positie. De speler verliest een punt voor elke peg in de verkeerde
        positie en kleur. De speler wint het spel als ze de code raden binnen
        twaalf keer raden.
    EOT
];