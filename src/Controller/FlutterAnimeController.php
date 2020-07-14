<?php

namespace App\Controller;

use App\Entity\DroneUser;
use App\Entity\FlutterAnime;
use App\Repository\FlutterAnimeRepository;
use App\Service\DroneService;
use App\Repository\DroneUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/flutter/anime/cmd")
 */
class FlutterAnimeController extends AbstractController
{
    private $finder;
    private $service;
    private $doctrine;

    public function __construct(FlutterAnimeRepository $finder, DroneService $service,
                                EntityManagerInterface $doctrine)
    {
        $this->finder = $finder;
        $this->service = $service;
        $this->doctrine = $doctrine;
    }

    /**
     * @Route("/store", name="api_flutter_anime_cmd_store", methods={"POST"})
     */
    public function store(Request $request) {

        $data = $request->getContent();
        $data = json_decode($data, true);

        $object = FlutterAnime::fromArray($data);

        if ($this->service->hasError($object)) {
            return $this->json([
                "message" => $this->service->getMessage($object)
            ], JsonResponse::HTTP_CONFLICT);
        }

        $this->doctrine->persist($object);
        $this->doctrine->flush();

        return $this->json($object->toArray());
    }

    /**
     * @Route("/delete/{id}", name="api_flutter_anime_cmd_delete", methods={"DELETE"})
     */
    public function delete(FlutterAnime $anime) {

        $this->doctrine->remove($anime);
        $this->doctrine->flush();

        return $this->json(['success' => true]);
    }
}
