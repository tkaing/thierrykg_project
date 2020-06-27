<?php

namespace App\Repository;

use App\Entity\DroneUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DroneUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method DroneUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method DroneUser[]    findAll()
 * @method DroneUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DroneUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DroneUser::class);
    }

    // /**
    //  * @return DroneUser[] Returns an array of DroneUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DroneUser
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
