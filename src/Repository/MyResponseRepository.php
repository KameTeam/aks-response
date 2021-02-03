<?php

namespace App\Repository;

use App\Entity\MyResponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MyResponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyResponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyResponse[]    findAll()
 * @method MyResponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyResponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MyResponse::class);
    }

    // /**
    //  * @return MyResponse[] Returns an array of MyResponse objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MyResponse
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
