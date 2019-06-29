<?php

namespace App\Repository;

use App\Entity\ActivityImagesLink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ActivityImagesLink|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActivityImagesLink|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActivityImagesLink[]    findAll()
 * @method ActivityImagesLink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivityImagesLinkRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ActivityImagesLink::class);
    }

    // /**
    //  * @return ActivityImagesLink[] Returns an array of ActivityImagesLink objects
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
    public function findOneBySomeField($value): ?ActivityImagesLink
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
