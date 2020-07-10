<?php

namespace App\Controller;

use App\Entity\DroneSession;
use App\Entity\DroneSessionDetails;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DroneSessionDetailsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/drone/details/query", methods={"GET"})
 */
class DroneSessionDetailsQueryController extends AbstractController
{
    private $finder;

    public function __construct(DroneSessionDetailsRepository $finder)
    {
        $this->finder = $finder;
    }

    /**
     * @Route("/id/{id}", name="api_drone_details_query_id")
     */
    public function id(int $id) {

        $object = $this->finder->find($id);

        if (!$object instanceof DroneSessionDetails)
            throw $this->createNotFoundException();

        return $this->json($object->toArray());
    }

    /**
     * @Route("/list/all", name="api_drone_details_query_list_all")
     */
    public function listAll() {

        $objects = $this->finder->findAll();

        return $this->json(array_map(function (DroneSessionDetails $object) {
            return $object->toArray();
        }, $objects));
    }

    /**
     * @Route("/list/session/{id}", name="api_drone_details_query_list_session")
     */
    public function listBySession(DroneSession $session) {

        $objects = $this->finder->findBy([
            'session' => $session
        ]);

        return $this->json(array_map(function (DroneSessionDetails $object) {
            return $object->toArray();
        }, $objects));
    }
}
