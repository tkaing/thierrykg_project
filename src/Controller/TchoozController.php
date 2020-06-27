<?php

namespace App\Controller;

use App\Entity\Tirage;
use App\Entity\Participant;
use App\Service\EncoderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TchoozController extends AbstractController
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
     * @Route("/tchooz/form", name="tchooz-form", methods={"GET"})
     */
    public function form()
    {
        return $this->render('tchooz/form.html.twig');
    }

    /**
     * @Route("/tchooz/show/{uniqueId}/{creatorUniqueId}", name="tchooz-show", methods={"GET"})
     */
    public function show(Tirage $tirage, string $creatorUniqueId = null)
    {
        $creator = $tirage->getCreator();
        $is_creator = Participant::isCreator($tirage, $creatorUniqueId);

        $participants = $tirage->getParticipants();
        $participants->removeElement($creator);

        return $this->render('tchooz/show.html.twig', [
            'tirage' => $tirage,
            'participants' => $participants,
            'is_creator_url' => $is_creator
        ]);
    }
}
