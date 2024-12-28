<?php

namespace App\Repository;

use App\Entity\LibelleMesures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LibelleMesures|null find($id, $lockMode = null, $lockVersion = null)
 * @method LibelleMesures|null findOneBy(array $criteria, array $orderBy = null)
 * @method LibelleMesures[]    findAll()
 * @method LibelleMesures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LibelleMesuresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LibelleMesures::class);
    }

    // /**
    //  * @return LibelleMesures[] Returns an array of LibelleMesures objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LibelleMesures
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
