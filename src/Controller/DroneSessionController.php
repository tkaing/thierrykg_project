<?php

namespace App\Controller;

use App\Entity\DroneSession;
use App\Entity\DroneUser;
use App\Repository\DroneUserRepository;
use App\Service\DroneService;
use App\Repository\DroneSessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
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
    private $doctrine;
    private $finderUser;

    public function __construct(DroneSessionRepository $finder, DroneService $service,
                                EntityManagerInterface $doctrine, DroneUserRepository $finderUser)
    {
        $this->finder = $finder;
        $this->service = $service;
        $this->doctrine = $doctrine;
        $this->finderUser = $finderUser;
    }

    /**
     * @Route("/store", name="api_drone_session_cmd_store", methods={"POST"})
     */
    public function store(Request $request) {

        $data = $request->getContent();
        $data = json_decode($data, true);

        if ($this->hasUserError($data)) {
            return $this->json([
                'message' => $this->getUserMessage($data)->first()
            ], JsonResponse::HTTP_PARTIAL_CONTENT);
        }

        $user = $this->fetchUser($data);
        $object = DroneSession::fromArray($data, $user);

        if ($this->service->hasError($object)) {
            return $this->json([
                'message' => $this->service->getMessage($object)
            ], JsonResponse::HTTP_PARTIAL_CONTENT);
        }

        $this->doctrine->persist($object);
        $this->doctrine->flush();

        return $this->json($object->toArray());
    }

    private function fetchUser(array $data) {

        return $this->finderUser->find($data['userId']);
    }

    private function hasUserError(array $data) {

        return $this->getUserMessage($data)->count() > 0;
    }

    private function getUserMessage(array $data) {

        $user_id = $data['userId'] ?? -1;
        $messageList = new ArrayCollection();

        if ($user_id === -1)
            $messageList->add('userId is required.');

        elseif (!is_numeric($user_id))
            $messageList->add('userId must be numeric.');

        $user = $this->finderUser->find($user_id);

        if (!$user instanceof DroneUser)
            $messageList->add("User with id($user_id) doesn't exist.");

        return $messageList;
    }
}
