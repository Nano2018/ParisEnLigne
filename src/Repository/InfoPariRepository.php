<?php

namespace App\Repository;

use App\Entity\InfoPari;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InfoPari|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfoPari|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfoPari[]    findAll()
 * @method InfoPari[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfoPariRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InfoPari::class);
    }

    // /**
    //  * @return InfoPari[] Returns an array of InfoPari objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InfoPari
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
