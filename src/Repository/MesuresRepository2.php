<?php

namespace App\Repository;

use App\Entity\Mesures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mesures|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mesures|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mesures[]    findAll()
 * @method Mesures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MesuresRepository2 extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mesures::class);
    }

    public function findByHumChDateRangeCount($minDate, $maxDate)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.libelleMesures = 2')
            ->andWhere('a.createdAt >= :minVal')
            ->setParameter('minVal', $minDate)
            ->andWhere('a.createdAt <= :maxVal')
            ->setParameter('maxVal', $maxDate)
            ->select('count(a.valeur)')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function findByHumChDateRangeValeur($minDate, $maxDate)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.libelleMesures = 2')
            ->andWhere('a.createdAt >= :minVal')
            ->setParameter('minVal', $minDate)
            ->andWhere('a.createdAt <= :maxVal')
            ->setParameter('maxVal', $maxDate)
            ->select('a.valeur')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function findByHumChDateRange($minDate, $maxDate)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.libelleMesures = 2')
            ->andWhere('a.createdAt >= :minVal')
            ->setParameter('minVal', $minDate)
            ->andWhere('a.createdAt <= :maxVal')
            ->setParameter('maxVal', $maxDate)
            ->select('a.createdAt')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }


    public function findByHumSrDateRangeCount($minDate, $maxDate)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.libelleMesures = 4')
            ->andWhere('a.createdAt >= :minVal')
            ->setParameter('minVal', $minDate)
            ->andWhere('a.createdAt <= :maxVal')
            ->setParameter('maxVal', $maxDate)
            ->select('count(a.valeur)')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function findByHumSrDateRangeValeur($minDate, $maxDate)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.libelleMesures = 4')
            ->andWhere('a.createdAt >= :minVal')
            ->setParameter('minVal', $minDate)
            ->andWhere('a.createdAt <= :maxVal')
            ->setParameter('maxVal', $maxDate)
            ->select('a.valeur')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function findByHumSrDateRange($minDate, $maxDate)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.libelleMesures = 4')
            ->andWhere('a.createdAt >= :minVal')
            ->setParameter('minVal', $minDate)
            ->andWhere('a.createdAt <= :maxVal')
            ->setParameter('maxVal', $maxDate)
            ->select('a.createdAt')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }


    public function findByTempChDateRangeCount($minDate, $maxDate)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.libelleMesures = 1')
            ->andWhere('a.createdAt >= :minVal')
            ->setParameter('minVal', $minDate)
            ->andWhere('a.createdAt <= :maxVal')
            ->setParameter('maxVal', $maxDate)
            ->select('count(a.valeur)')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function findByTempChDateRangeValeur($minDate, $maxDate)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.libelleMesures = 1')
            ->andWhere('a.createdAt >= :minVal')
            ->setParameter('minVal', $minDate)
            ->andWhere('a.createdAt <= :maxVal')
            ->setParameter('maxVal', $maxDate)
            ->select('a.valeur')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function findByTempChDateRange($minDate, $maxDate)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.libelleMesures = 1')
            ->andWhere('a.createdAt >= :minVal')
            ->setParameter('minVal', $minDate)
            ->andWhere('a.createdAt <= :maxVal')
            ->setParameter('maxVal', $maxDate)
            ->select('a.createdAt')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }


    public function findByTempSrDateRangeCount($minDate, $maxDate)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.libelleMesures = 3')
            ->andWhere('a.createdAt >= :minVal')
            ->setParameter('minVal', $minDate)
            ->andWhere('a.createdAt <= :maxVal')
            ->setParameter('maxVal', $maxDate)
            ->select('count(a.valeur)')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function findByTempSrDateRangeValeur($minDate, $maxDate)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.libelleMesures = 3')
            ->andWhere('a.createdAt >= :minVal')
            ->setParameter('minVal', $minDate)
            ->andWhere('a.createdAt <= :maxVal')
            ->setParameter('maxVal', $maxDate)
            ->select('a.valeur')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function findByTempSrDateRange($minDate, $maxDate)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.libelleMesures = 3')
            ->andWhere('a.createdAt >= :minVal')
            ->setParameter('minVal', $minDate)
            ->andWhere('a.createdAt <= :maxVal')
            ->setParameter('maxVal', $maxDate)
            ->select('a.createdAt')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByDate($minDate, $maxDate)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.createdAt >= :minVal')
            ->setParameter('minVal', $minDate)
            ->andWhere('a.createdAt <= :maxVal')
            ->setParameter('maxVal', $maxDate)
            ->select('a.id')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findById($minId, $maxId)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.id >= :minVal')
            ->setParameter('minVal', $minId)
            ->andWhere('a.id <= :maxVal')
            ->setParameter('maxVal', $maxId)
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }


}