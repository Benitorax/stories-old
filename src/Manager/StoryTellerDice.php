<?php

namespace App\Manager;

class StoryTellerDice
{
    public const YELLOW_DICE = [
        "Je dois vous avouer",
        "Vous n'allez pas me croire",
        "L'autre jour",
        "Aloooors",
        "Bon écoutez-moi !",
        "Vous savez que",
        "Quand j'étais petit",
        "La semaine dernière",
        "Tout le monde pense",
        "Je vous ai jamais dit",
        "Un beau jour",
        "Je connais quelqu'un",
        "Ce matin",
        "La nuit dernière",
        "Quand j'étais bébé",
        "À ma naissance",
        "Un soir",
        "La nuit dernière"
    ];
    public const ORANGE_DICE = [
        "Donc",
        "C'est pourquoi",
        "Mais",
        "J'ajoute",
        "Or",
        "Hélas !",
        "En général",
        "En réalité",
        "Et croyez-moi",
        "Mais vous savez quoi ?",
        "En plus",
        "Alors moi",
        "Et puis",
        "Pour votre information",
        "Malgré",
        "Normalement",
        "Malheureusement",
        "Bien que",
        "Surtout",
        "D'ailleurs"
    ];
    public const RED_DICE = [
        "Vous allez me dire",
        "Bon, vous me connaissez",
        "Tout à coup",
        "Je précise que",
        "En fait",
        "Le plus drôle",
        "Vous ignorez",
        "Donc, sans hésiter",
        "En tout cas",
        "Alors voilà",
        "Pas de bol",
        "Quand soudain",
        "A mon avis",
        "Entre parenthèses",
        "À ma connaissance",
        "En temps normal",
        "Alors que",
        "Étant donné",
        "Vous savez",
        "Et pourtant",
        "Sans compter",
        "Contrairement à"
    ];
    public const VIOLET_DICE = [
        "D'un autre côté",
        "Là ça se complique",
        "Et là, surprise",
        "C'est vrai que",
        "Du coup",
        "Ah, j'oubliais !",
        "Coup de bol",
        "Mais c'est pas si grave",
        "Comme par hasard",
        "Ni une, ni deux",
        "Et figurez-vous",
        "A ce moment là",
        "Il y a aussi",
        "Ce jour-là",
        "Plus sérieusement",
        "Incroyable mais vrai",
        "Étonnamment",
        "Je dois absolument ajouter",
        "Vous n'allez pas me croire",
        "À noter que"
    ];
    public const BLUE_DICE = [
        "Et là, patatras !",
        "J'avais prévu le coup",
        "Bref !",
        "Moi tranquille",
        "Finalement",
        "Et le pire !",
        "Comme vous pouvez le voir",
        "En vérité",
        "En contrepartie",
        "Et la poisse !",
        "Et miracle",
        "Quel bonheur",
        "Par mégarde",
        "Je ne m'attendais pas",
        "Je suis inquiet",
        "Heureusement",
        "Toutefois",
        "Néanmoins"
    ];
    public const DARK_BLUE_DICE = [
        "Et le drame",
        "C'est comme ça que",
        "Alors, vous allez rire",
        "Conclusion",
        "La prochaine fois",
        "Comme dirait ma mamie",
        "Sauf que",
        "Comme dirait mon pépé",
        "C'est ainsi que",
        "Et tenez-vous bien",
        "Moralité",
        "Et comme par magie",
        "Comme dirait mon fils",
        "Comme dirait ma fille",
        "C'est pourquoi",
        "Comme on dit souvent",
        "Par conséquent",
        "Bref",
        "Au fond",
        "En dernière analyse",
        "Après réflexion"
    ];
    public const WHITE_DICE = [
        "Et là, COUIC !",
        "Et là, Grrr !",
        "Et là, PAF !",
        "Et là, nooon !",
        "Et là, ouiii !",
        "Et là, Hmmm",
        "Et là, tin, tin, tiin !",
        "Et là, CLAC !",
        "Et là, CRAC !",
        "Et là, CLAP !",
        "Et là, CLIC !",
        "Et là, SPLASH !",
        "Et là, Biiip !",
        "Et là, BOUM !",
        "Et là, WOOOOW !",
        "Et là, MIAOUUU !",
        "Et là, glou glou !",
        "Et là, DING-DONG !",
        "Et là, Meuuuh !",
        "Et là, WOUAF WOUAF !",
        "Et là, Bzzz !",
        "Et là, argh !",
        "Et là, AIE !",
        "Et là, OUILLE !",
        "Et là, CRAC !",
        "Et là, tic-tac !",
        "Et là, VROUUUM !",
    ];

    public function getOneYellowSentence()
    {
        return self::YELLOW_DICE[
            array_rand(self::YELLOW_DICE, 1)
        ];
    }

    public function getOneOrangeSentence()
    {
        return self::ORANGE_DICE[
            array_rand(self::ORANGE_DICE, 1)
        ];
    }

    public function getOneRedSentence()
    {
        return self::RED_DICE[
            array_rand(self::RED_DICE, 1)
        ];
    }

    public function getOneVioletSentence()
    {
        return self::VIOLET_DICE[
            array_rand(self::VIOLET_DICE, 1)
        ];
    }

    public function getOneBlueSentence()
    {
        return self::BLUE_DICE[
            array_rand(self::BLUE_DICE, 1)
        ];
    }

    public function getOneDarkBlueSentence()
    {
        return self::DARK_BLUE_DICE[
            array_rand(self::DARK_BLUE_DICE, 1)
        ];
    }

    public function getOneWhiteSentence()
    {
        return self::WHITE_DICE[
            array_rand(self::WHITE_DICE, 1)
        ];
    }
}
