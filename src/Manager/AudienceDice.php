<?php

namespace App\Manager;

class AudienceDice
{
    public const BLACK_DICE = [
        "Ça c'est faux",
        "Moi ça me rappelle",
        "Avec du beurre ?",
        "Il était quelle heure ?",
        "T'oublie pas un détail ?",
        "C'est vrai, d'ailleurs",
        "J'ai pas compris",
        "Hop hop hop",
        "Et ton chien dans tout ça ?",
        "T'as pas eu trop peur ?",
        "Tu veux mon avis ?",
        "J'adore ce passage !",
        "Ah bon ? Pourquoi ?",
        "Tu peux le prouver ?",
        "Ça me dégoute",
        "Je te comprends",
        "Certains doutent encore",
        "On est tous d'accord",
        "C'était quel jour ?",
        "Félicitations pour",
        "Tu nous cache la vérité",
        "Ton chat il en pense quoi ?",
        "Si je comprends bien",
        "C'était où ?",
        "Était-ce possible",
        "Et pourquoi",
        "Et si",
        "Ok, admettons",
        "Comment a réagi ta famille ?",
        "Peut-être que",
        "Il faisait froid ?",
        "Il faisait chaud ?"
    ];

    public function getOneSentence(): string
    {
        return self::BLACK_DICE[
            array_rand(self::BLACK_DICE, 1)
        ];
    }
}
