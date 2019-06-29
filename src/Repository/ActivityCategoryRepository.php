<?php

namespace App\Repository;

use App\Entity\ActivityCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ActivityCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActivityCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActivityCategory[]    findAll()
 * @method ActivityCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivityCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ActivityCategory::class);
    }

    // /**
    //  * @return ActivityCategory[] Returns an array of ActivityCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ActivityCategory
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
