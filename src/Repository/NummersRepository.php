<?php

namespace App\Repository;

use App\Entity\Nummers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Nummers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nummers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nummers[]    findAll()
 * @method Nummers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NummersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nummers::class);
    }

    // /**
    //  * @return Nummers[] Returns an array of Nummers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nummers
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
