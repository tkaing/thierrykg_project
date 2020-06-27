<?php

namespace App\Controller;

use App\Entity\DroneSession;
use App\Service\DroneService;
use App\Entity\DroneSessionDetails;
use App\Repository\DroneSessionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\DroneSessionDetailsRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/drone/session-details/cmd")
 */
class DroneSessionDetailsController extends AbstractController
{
    private $finder;
    private $service;
    private $finderSession;

    public function __construct(DroneSessionDetailsRepository $finder, DroneService $service,
                                DroneSessionRepository $finderSession)
    {
        $this->finder = $finder;
        $this->service = $service;
        $this->finderSession = $finderSession;
    }

    /**
     * @Route("/store", name="api_drone_session_details_cmd_store", methods={"POST"})
     */
    public function store(Request $request) {

        $data = $request->getContent();
        $data = json_decode($data, true);

        if ($this->hasSessionError($data)) {
            return $this->json([
                'message' => $this->getSessionMessage($data)->first()
            ], JsonResponse::HTTP_PARTIAL_CONTENT);
        }

        $session = $this->fetchSession($data);
        $object = DroneSessionDetails::fromArray($data, $session);

        if ($this->service->hasError($object)) {
            return $this->json([
                'message' => $this->service->getMessage($object)
            ], JsonResponse::HTTP_PARTIAL_CONTENT);
        }

        return $this->json($object);
    }

    private function fetchSession(array $data) {

        return $this->finderSession->find($data['sessionId']);
    }

    private function hasSessionError(array $data) {

        return $this->getSessionMessage($data)->count() > 0;
    }

    private function getSessionMessage(array $data) {

        $session_id = $data['sessionId'] ?? -1;
        $messageList = new ArrayCollection();

        if ($session_id === -1)
            $messageList->add('sessionId is required.');

        elseif (!is_numeric($session_id))
            $messageList->add('sessionId must be numeric.');

        $session = $this->finderSession->find($session_id);

        if (!$session instanceof DroneSession)
            $messageList->add("Session with id($session_id) doesn't exist.");

        return $messageList;
    }
}
