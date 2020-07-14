<?php

namespace App\Repository;

use App\Entity\FlutterAnime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FlutterAnime|null find($id, $lockMode = null, $lockVersion = null)
 * @method FlutterAnime|null findOneBy(array $criteria, array $orderBy = null)
 * @method FlutterAnime[]    findAll()
 * @method FlutterAnime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlutterAnimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FlutterAnime::class);
    }

    // /**
    //  * @return FlutterAnime[] Returns an array of FlutterAnime objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FlutterAnime
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
