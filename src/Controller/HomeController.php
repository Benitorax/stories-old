<?php

namespace App\Controller;

use App\Manager\SubjectData;
use App\Manager\AudienceDice;
use App\Manager\StoryTellerDice;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="main", methods={"GET"})
     */
    public function main(): Response
    {
        return $this->render('home/main.html.twig', [
        ]);
    }

    /**
     * @Route("/api/dice/number", name="stories_dice_number", methods={"GET"})
     */
    public function getRandomNumber(): Response
    {
        return $this->json([
            'number' => rand(1, 6)
        ]);
    }

    /**
     * @Route("/api/subject", name="stories_subject", methods={"GET"})
     */
    public function getRandomSubject(): Response
    {
        return $this->json([
            'subject' => (new SubjectData())->getOneSubject()
        ]);
    }

    /**
     * @Route("/api/dice/yellow", name="stories_dice_yellow", methods={"GET"})
     */
    public function getRandomYellowDice(): Response
    {
        return $this->json([
            'message' => (new StoryTellerDice())->getOneYellowSentence()
        ]);
    }

    /**
     * @Route("/api/dice/orange", name="stories_dice_orange", methods={"GET"})
     */
    public function getRandomOrangeDice(): Response
    {
        return $this->json([
            'message' => (new StoryTellerDice())->getOneOrangeSentence()
        ]);
    }

    /**
     * @Route("/api/dice/red", name="stories_dice_red", methods={"GET"})
     */
    public function getRandomRedDice(): Response
    {
        return $this->json([
            'message' => (new StoryTellerDice())->getOneRedSentence()
        ]);
    }

    /**
     * @Route("/api/dice/violet", name="stories_dice_violet", methods={"GET"})
     */
    public function getRandomVioletDice(): Response
    {
        return $this->json([
            'message' => (new StoryTellerDice())->getOneVioletSentence()
        ]);
    }

    /**
     * @Route("/api/dice/blue", name="stories_dice_blue", methods={"GET"})
     */
    public function getRandomBlueDice(): Response
    {
        return $this->json([
            'message' => (new StoryTellerDice())->getOneBlueSentence()
        ]);
    }

    /**
     * @Route("/api/dice/dark-blue", name="stories_dice_dark_blue", methods={"GET"})
     */
    public function getRandomDarkBlueDice(): Response
    {
        return $this->json([
            'message' => (new StoryTellerDice())->getOneDarkBlueSentence()
        ]);
    }

    /**
     * @Route("/api/dice/white", name="stories_dice_white", methods={"GET"})
     */
    public function getRandomWhiteDice(): Response
    {
        return $this->json([
            'message' => (new StoryTellerDice())->getOneWhiteSentence()
        ]);
    }

    /**
     * @Route("/api/dice/black", name="stories_dice_black", methods={"GET"})
     */
    public function getRandomBlackDice(): Response
    {
        return $this->json([
            'message' => (new AudienceDice())->getOneSentence()
        ]);
    }
}
