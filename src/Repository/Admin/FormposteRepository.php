<?php

namespace App\Repository\Admin;

use App\Entity\Admin\Formposte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Formposte|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formposte|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formposte[]    findAll()
 * @method Formposte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormposteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formposte::class);
    }

    // /**
    //  * @return Formposte[] Returns an array of Formposte objects
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
    public function findOneBySomeField($value): ?Formposte
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
