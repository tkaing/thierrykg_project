<?php

namespace App\Controller;

use App\Entity\DroneSession;
use App\Service\DroneService;
use App\Repository\DroneSessionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/drone/session/cmd")
 */
class DroneSessionController extends AbstractController
{
    private $finder;
    private $service;

    public function __construct(DroneSessionRepository $finder, DroneService $service)
    {
        $this->finder = $finder;
        $this->service = $service;
    }

    /**
     * @Route("/store", name="api_drone_session_cmd_store", methods={"POST"})
     */
    public function store(Request $request) {

        $data = $request->getContent();
        $data = json_decode($data, true);

        $object = DroneSession::fromArray($data);

        if ($this->service->hasError($object)) {
            return $this->json([
                'message' => $this->service->getMessage($object)
            ], JsonResponse::HTTP_PARTIAL_CONTENT);
        }

        return $this->json($object);
    }
}
