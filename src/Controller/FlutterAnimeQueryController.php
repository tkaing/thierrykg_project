<?php

namespace App\Controller;

use App\Entity\DroneUser;
use App\Repository\DroneUserRepository;
use App\Repository\FlutterAnimeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/flutter/anime/query", methods={"GET"})
 */
class FlutterAnimeQueryController extends AbstractController
{
    private $finder;

    public function __construct(FlutterAnimeRepository $finder)
    {
        $this->finder = $finder;
    }

    /**
     * @Route("/list/all", name="api_flutter_anime_query_list_all")
     */
    public function listAll() {

        $objects = $this->finder->findAll();

        return $this->json(array_map(function (DroneUser $object) {
            return $object->toArray();
        }, $objects));
    }
}
