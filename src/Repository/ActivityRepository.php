<?php

namespace App\Repository;

use App\Entity\Activity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Activity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activity[]    findAll()
 * @method Activity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Activity::class);
    }

    public function findActivitiesPreparedArr($orderBy = 'DESC', $limit = null, $offset = 0)
    {
        if ($limit < 1) {
            $limit = null;
        }
        $items = $this->createQueryBuilder('a')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('a.price', $orderBy)
            ->getQuery()
            ->getResult();
        return $this->prepareArray($items);
    }

    public function findActivityPreparedArr($valueName, $value, $orderBy = 'DESC', $limit = null, $offset = 0)
    {
        if ($limit < 1) {
            $limit = null;
        }
        $items = $this->createQueryBuilder('a')
            ->andWhere('a.'.$valueName.'='.$value)
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('a.price', $orderBy)
            ->getQuery()
            ->getResult();

        return $this->prepareArray($items);
    }

    public function findActivityMaxPreparedArr($valueName, $value, $orderBy = 'DESC', $limit = null, $offset = 0)
    {
        if ($limit < 1) {
            $limit = null;
        }
        $items = $this->createQueryBuilder('a')
            ->andWhere('a.'.$valueName.'<='.$value)
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('a.price', $orderBy)
            ->getQuery()
            ->getResult();

        return $this->prepareArray($items);
    }

    public function findActivityByCategoryPreparedArr($categoryId, $orderBy = 'DESC', $limit = null, $offset = 0)
    {
        if ($limit < 1) {
            $limit = null;
        }
        $items = $this->createQueryBuilder('a')
            ->where(':categoryId MEMBER OF a.categories')
            ->setParameter("categoryId", $categoryId)
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('a.price', $orderBy)
            ->getQuery()
            ->getResult();

        return $this->prepareArray($items);
    }

    private function prepareArray($items)
    {
        $result = [];
        /** @var Activity $item */
        foreach ($items as $item) {
            $result[] = [
                'id' => $item->getId(),
                'popular' => $item->getPopular(),
                'name' => $item->getName(),
                'description' => $item->getDescription(),
                'price' => $item->getPrice(),
                'images' => $item->getImageUrlArray(),
                'category' => $item->getCategoriesArr(),
            ];
        }
        return $result;
    }
}
