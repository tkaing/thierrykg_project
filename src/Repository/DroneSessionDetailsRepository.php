<?php

namespace App\Repository;

use App\Entity\DroneSessionDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DroneSessionDetails|null find($id, $lockMode = null, $lockVersion = null)
 * @method DroneSessionDetails|null findOneBy(array $criteria, array $orderBy = null)
 * @method DroneSessionDetails[]    findAll()
 * @method DroneSessionDetails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DroneSessionDetailsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DroneSessionDetails::class);
    }

    // /**
    //  * @return DroneSessionDetails[] Returns an array of DroneSessionDetails objects
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
    public function findOneBySomeField($value): ?DroneSessionDetails
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
