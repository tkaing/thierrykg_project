<?php

namespace App\Controller;

use App\Entity\Tirage;
use App\Entity\Participant;
use App\Service\EncoderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TchoozCommanderController extends AbstractController
{
    private $manager;
    private $utilsEncoder;

    public function __construct(EntityManagerInterface $manager,
                                EncoderService $utilsEncoder)
    {
        $this->manager = $manager;
        $this->utilsEncoder = $utilsEncoder;
    }

    /**
     * @Route("/tchooz/tirage/store", name="tchooz-tirage-store", methods={"POST"})
     */
    public function storeTirage(Request $request)
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $data = $request->get('tirage');
        $data = json_decode($data);

        $tirage = new Tirage();
        $tirage->setName($data->name);

        $this->manager->persist($tirage);
        $this->manager->flush();

        $participant = new Participant();
        $participant->setPseudo('le créateur');
        $participant->setTirage($tirage);

        $tirageUniqueId = $this->utilsEncoder->encode($tirage->getId(), "tirage-{$tirage->getName()}");
        $tirage->setUniqueId($tirageUniqueId);

        $this->manager->persist($participant);
        $this->manager->flush();

        $participantUniqueId = $this->utilsEncoder->encode($participant->getId(), "participant-{$participant->getPseudo()}");
        $participant->setUniqueId($participantUniqueId);
        $tirage->setCreator($participant);

        $this->manager->flush();

        return new JsonResponse([
            'url' => $this->generateUrl('tchooz-show', [
                'uniqueId' => $tirage->getUniqueId(),
                'creatorUniqueId' => $participant->getUniqueId()
            ])
        ]);
    }

    /**
     * @Route("/tchooz/participant/store-all/{uniqueId}", name="tchooz-participant-store-all", methods={"POST"})
     */
    public function storeAllParticipant(Request $request, Tirage $tirage)
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $data = $request->get('participants');
        $data = json_decode($data);
        dump($data);die;

        $participant = new Participant();
        $participant->setTirage($tirage);
        $participant->setPseudo($data->name);
        $participant->setUniqueId($data->code);

        //$this->manager->persist($participant);
        //$this->manager->flush();

        return new JsonResponse();
    }

    /**
     * @Route("/tchooz/participant/patch-wishlist", name="tchooz-participant-patch-wishlist", methods={"PATCH"})
     */
    public function patchParticipantWishlist(Request $request)
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();
    }
}
