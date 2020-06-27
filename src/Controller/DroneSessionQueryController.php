<?php

namespace App\Controller;

use App\Entity\DroneSession;
use App\Repository\DroneSessionRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/drone/session/query", methods={"GET"})
 */
class DroneSessionQueryController extends AbstractController
{
    private $finder;

    public function __construct(DroneSessionRepository $finder)
    {
        $this->finder = $finder;
    }

    /**
     * @Route("/id/{id}", name="api_drone_session_query_id")
     */
    public function id(int $id) {

        $object = $this->finder->find($id);

        if (!$object instanceof DroneSession)
            throw $this->createNotFoundException();

        return $this->json($object->toArray());
    }
}
