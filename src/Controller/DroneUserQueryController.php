<?php

namespace App\Controller;

use App\Entity\DroneUser;
use App\Repository\DroneUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/drone/user/query", methods={"GET"})
 */
class DroneUserQueryController extends AbstractController
{
    private $finder;

    public function __construct(DroneUserRepository $finder)
    {
        $this->finder = $finder;
    }

    /**
     * @Route("/id/{id}", name="api_drone_user_query_id")
     */
    public function id(int $id) {

        $object = $this->finder->find($id);

        if (!$object instanceof DroneUser)
            throw $this->createNotFoundException();

        return $this->json($object->toArray());
    }

    /**
     * @Route("/pseudo/{pseudo}", name="api_drone_user_query_pseudo")
     */
    public function pseudo(string $pseudo) {

        $object = $this->finder->findOneBy(['pseudo' => $pseudo]);

        if (!$object instanceof DroneUser)
            throw $this->createNotFoundException();

        return $this->json($object->toArray());
    }

    /**
     * @Route("/pseudo/password/{pseudo}/{password}", name="api_drone_user_query_pseudo_and_password")
     */
    public function pseudoAndPassword(string $pseudo, string $password) {

        $object = $this->finder->findOneBy(['pseudo' => $pseudo, 'password' => $password]);

        if (!$object instanceof DroneUser)
            throw $this->createNotFoundException();

        return $this->json($object->toArray());
    }

    /**
     * @Route("/list/all", name="api_drone_user_query_list_all")
     */
    public function listAll() {

        $objects = $this->finder->findAll();

        return $this->json(array_map(function (DroneUser $object) {
            return $object->toArray();
        }, $objects));
    }
}
