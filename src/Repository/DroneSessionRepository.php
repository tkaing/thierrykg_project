<?php

namespace App\Repository;

use App\Entity\DroneSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DroneSession|null find($id, $lockMode = null, $lockVersion = null)
 * @method DroneSession|null findOneBy(array $criteria, array $orderBy = null)
 * @method DroneSession[]    findAll()
 * @method DroneSession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DroneSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DroneSession::class);
    }

    // /**
    //  * @return DroneSession[] Returns an array of DroneSession objects
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
    public function findOneBySomeField($value): ?DroneSession
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
