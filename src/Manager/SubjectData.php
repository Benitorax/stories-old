<?php
namespace App\Manager;

class SubjectData
{
    const SUBJECTS = [
        "J’ai été enlevé(e) par des extra-terrestres.",
        "Je lis l'avenir dans la purée de pommes de terres.",
        "Je vous raconte mon prochain film.",
        "J'ai passé une très bonne soirée avec une fée...",
        "Un jour, j'ai mangé 23 oeufs durs !",
        "Comment réparer un moteur de tracteur avec une trombone.",
        "Le crime était presque parfait.",
        "La préhistoire, c'était vachement sympa !",
        "J'ai un doigt magique.",
        "J'aime bien les gens qui ne m'aiment pas.",
        "Je me suis remis(e) à la luge.",
        "Dans la Lune...",
        "J'ai embrassé un crapaud.",
        "Je viens d'une famille très spéciale.",
        "Mes petites astuces pour séduire.",
        "La machine à voyager dans le temps. Mon expérience.",
        "J'ai inventé un nouveau sport.",
        "Je vais vous avouer quelque chose de grave.",
        "Bloqué(e) dans un ascenseur.",
        "Il va y avoir une grande exposition de mes oeuvres.",
        "Le pique-nique infernal...",
        "En cuisine, j'improvise avec n'importe quoi.",
        "J'ai jamais pu retirer mes skis.",
        "Ma collection unique au monde.",
        "Je ne me déplace qu'à cheval.",
        "Un bébé m'a sauvé la vie.",
        "C'est pas toujours super de gagner au loto.",
        "Mon dentiste est fou.",
        "Le bonheur d'être seul(e).",
        "Une baleine s'est échouée dans ma baignoire",
        "Je suis recherché(e) par la police de l'Amérique du Sud.",
        "Pourquoi je suis devenu(e) clown.",
        "La légende du chevalier sans épée.",
        "Mon chien est addict à la cocaïne.",
        "Ma grand-mère vend de la drogue.",
        "Je ronfle même éveillé(e).",
        "Je suis allergique à l'eau !",
        "Comment j'ai bâti mon immense fortune !",
        "Une histoire tellement courte.",
        "Mon coiffeur est cinglé.",
        "Sincèrement, je trouve que tout est beau.",
        "Mon séjour dans le Grand Nord.",
        "Je me suis embrouillé avec Vladimir Poutine.",
        "Il y a un génie dans ma cafétière.",
        "Mon programme politique pour la paix sur Terre.",
        "J'ai pris des cours de savoir-vivre.",
        "J'ai pas l'air comme ça, mais j'ai attaqué une banque.",
        "La panne d'essence...",
        "Une chèvre vit dans mes toilettes.",
        "Mon inoubliable soirée pyjama.",
        "Tu sais ce que j'ai retrouvé dans un nem ?",
        "J'ai un chien qui parle.",
        "C'est pas de ma faute, c'est mon coiffeur !",
        "J'ai rien à dire...",
        "Je vais vous dire qui je suis vraiment.",
        "Comment j'ai sali mon t-shirt.",
        "Pourquoi je ne prends qu'une douche tous les six mois.",
        "Comment un gnou m'a adopté(e).",
        "Comment j'ai adopté un gnou",
        "Je suis à l'origine d'une pandémie.",
        "Je me lave 1 fois par mois.",
        "J'ai participé à Miss Univers.",
        "Je fais la grosse commission uniquement chez les autres.",
        "Comment j'ai adopté un dragon.",
        "L'histoire du poisson qui n'aimait pas l'eau.",
        "L'entretien qui a changé ma vie.",
        "Je fais des supers imitations avec ma bouche.",
        "Je n'aurais pas dû dire non.",
        "J'ai un QI de 650.",
        "Les effets secondaires du Zunibate de Télurène.",
        "Y a du pétrole dans mon jardin !",
        "Comment je me suis fâché(e) avec le Président des Etats-Unis.",
        "Pardon, j'ai perdu la mémoire...",
        "Il y a un zombi parmi nous.",
        "Elle sera prête mardi.",
        "La fête à l'enterrement de ma grand-mère.",
        "La fôret maudite.",
        "J'habite dans un nid de pigeons.",
        "J'ai sauvé la planète mais personne ne le sait.",
        "Je suis un(e) magichien(ne).",
        "Le cimetière en folie.",
        "Ma voisine est millionnaire.",
        "Je me suis fait(e) virer de l'école des magiciens.",
        "J'ai les oreilles sur les pieds.",
        "Moi aussi, j'ai marché sur la Lune.",
        "Prisonnier(ère) de la tribu des Grobisous.",
        "La vengeance des marionnettes.",
        "Mon voisin dort dans un cercueil.",
        "En chassant les papillons, j'ai attrapé une fée.",
        "Mon colocataire est un fantôme.",
        "Je n'irai plus jamais au club des vampires.",
        "Avec ma licorne chez le vétérinaire.",
        "Comment j'ai réveillé la Belle au bois dormant.",
        "J'ai une petite voix dans ma tête.",
        "On m'avait dit : \"Ne souffle pas dans la trompe de l'éléphant !\"",
        "Un jour, j'ai dû punir mes parents.",
        "J'ai été attaqué(e) par un bateau pirate.",
        "Il était somnanbule.",
        "Oups j'ai avalé un perroquet !",
        "Ils se marièrent et eurent beaucoup de surprise.",
        "J'ai vécu trois mois avec un ogre.",
        "Perdu(e) dans la fôret des arbres vivants.",
        "Même pas peur !",
        "Mon pire réveillon de Noël.",
        "Et dans la bouteille, il y avait un message...",
        "Le prince un peu bête.",
        "J'ai acheté une lampe merveilleuse à la brocante de Nieul/mer.",
        "Mon pire poisson d'avril.",
        "J'ai récupéré les pouvoirs spéciaux de ma Mamie.",
        "J'ai creusé un trou un peu profond.",
        "Le train fantôme hyper atroce.",
        "J'ai trouvé une girafe dans mon grenier.",
        "Ma traversée de la jungle.",
        "La princesse qui puait des pieds.",
        "Petit(e), j'ai été élevé(e) par une famille de singes.",
        "Comment j'ai appris à voler.",
        "Mon miroir enchanté n'arrête pas de mentir.",
        "Je suis fan de Donald Trump.",
        "J'ai donné ma poule aux yeux d'or.",
        "Un soir d'orage, dans une maison abandonnée.",
        "Et là, j'ai appelé SOS Elfes.",
        "Mes amis sont des nains.",
        "Le maire de ma ville est un lapin.",
        "Quand j'étais réparateur(trice) de balais de sorcières.",
        "J'ai résisté aux chants d'une sirène.",
        "J'ai été champion d'Europe de cache-cache.",
        "Mon ombre fait n'importe quoi !",
        "J'ai vécu un incroyable tremblement de terre.",
        "Une nuit au musée.",
        "J'ai suivi un cours de \"traversage de murs\".",
        "Ma bagarre avec un chatonpotame.",
        "Le trésor était caché sous la... Aaaargh...",
        "L'histoire vraie du Titanic.",
        "Je me transforme en loup-garou.",
        "On m'a offert un château.",
        "Cette nuit, un pigeon voyageur m'a réveillé...",
        "Les WC étaients fermés de l'intérieur.",
        "Qu'est-ce qui m'a pris de répondre au shérif ?",
        "Mon anniversaire dans un labyrinthe.",
        "J'ai été récalé(e) au concours de super-héros.",
        "George, le chevalier timide.",
        "Les chaussures qui sautaient très haut.",
        "J'ai été enlevé(e) par des fourmis.",
        "J'ai goûté l'elixir de vieillesse de Maître Zou.",
        "Hier, j'ai reçu la famille Cannibale.",
        "Le durian, mon aliment préféré.",
        "Ma participation au Mudday en Corée du Nord.",
        "Le karaoké, une tradition dans la famille.",
        "Une relation compliquée avec les burpees.",
        "Mon meilleur ami est un kangourou.",
        "Kim Jong-Un, un membre de la famille.",
        "Champion(ne) du monde des roulades dans les escaliers.",
        "J'ai été élevé(e) par des escargots.'",
        "Mes parents sont accros au cannabis.",
        "Mes parents sont accros aux jeux vidéos.",
        "Mon Airbnb chez la reine d'Angleterre.",
        "Je suis militant(e) du Rassemblement National (Front National).",
        "Je suis responsable des grèves de train.",
        "Mes parents préfèrent leur chien à moi.",
        "Je suis videur pour une maison de retraite.",
        "On m'a confondu(e) avec une vache.",
        "Je suis plus intelligent(e) avec des pantoufles aux pieds.",
        "Mon animal de compagnie est raciste.",
        "Je vis dans un jeu vidéo.",
        "Il fait tout le temps nuit dans ma ville.",
        "Il pleut à chaque fois que je sors."
    ];

    public function getOneSubject() {
        return self::SUBJECTS[
            array_rand(self::SUBJECTS, 1)
        ];
    }
}