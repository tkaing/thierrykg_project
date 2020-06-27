<?php

namespace App\Controller;

use App\Entity\Tirage;
use App\Entity\Participant;
use App\Service\EncoderService;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ParticipantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TchoozQueryController extends AbstractController
{
    private $manager;
    private $utilsEncoder;
    private $finderParticipant;

    public function __construct(EntityManagerInterface $manager,
                                EncoderService $utilsEncoder,
                                ParticipantRepository $finderParticipant)
    {
        $this->manager = $manager;
        $this->utilsEncoder = $utilsEncoder;
        $this->finderParticipant = $finderParticipant;
    }

    /**
     * @Route("/tchooz/participant/get-unique-id", name="tchooz-participant-get-unique-id", methods={"GET"})
     */
    public function participantUniqueId(Request $request)
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $encoded = $this->utilsEncoder->encode(1, 'generate-unique-id', 4);

        return new JsonResponse([
            'participant_id' => $encoded
        ]);
    }

    /**
     * @Route("/tchooz/participant/get-wishlist/{uniqueId}/{participantUniqueId}", name="tchooz-participant-get-wishlist", methods={"GET"})
     */
    public function participantWishlist(Request $request, Tirage $tirage, string $participantUniqueId)
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $participant = $this->finderParticipant->findOneBy(['tirage' => $tirage, 'uniqueId' => $participantUniqueId]);

        $wishlist = "";

        if ($participant instanceof Participant) {
            $wishlist = $this->renderView('tchooz/show/wishlist.html.twig', [
                'tirage' => ['unique_id' => $tirage->getUniqueId()],
                'participant' => [
                    'unique_id' => $participant->getUniqueId(),
                    'pseudo' => $participant->getPseudo()
                ],
            ]);
        }

        return new JsonResponse([
            'wishlist' => $wishlist
        ]);
    }
}
