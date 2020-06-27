<?php

namespace App\Controller;

use App\Entity\DroneUser;
use App\Service\DroneService;
use App\Repository\DroneUserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/drone/user/cmd")
 */
class DroneUserController extends AbstractController
{
    private $finder;
    private $service;

    public function __construct(DroneUserRepository $finder, DroneService $service)
    {
        $this->finder = $finder;
        $this->service = $service;
    }

    /**
     * @Route("/sign-up", name="api_drone_user_cmd_sign_up", methods={"POST"})
     */
    public function signUp(Request $request) {

        $data = $request->getContent();
        $data = json_decode($data, true);

        $object = DroneUser::fromArray($data);

        if ($this->service->hasError($object)) {
            return $this->json([
                'message' => $this->service->getMessage($object)
            ], JsonResponse::HTTP_PARTIAL_CONTENT);
        }

        return $this->json($object);
    }
}
