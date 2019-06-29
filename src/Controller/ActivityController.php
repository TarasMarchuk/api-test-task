<?php

namespace App\Controller;


use App\Entity\Activity;
use App\Entity\ActivityCategory;
use App\Repository\ActivityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ActivityController
 * @package App\Controller
 * @Route("/activities")
 */
class ActivityController extends AbstractController
{
    /**
     * @Route("/maxprice/{maxpriceFilter}/{limit}/{offset}/{priceOrder}/{order}", defaults={"maxpriceFilter":0, "limit":null, "offset":0, "priceOrder":"", "order":"desc"}, requirements={"maxpriceFilter"="\d+", "page"="\d+", "offset"="\d+"})
     */
    public function maxpriceList($maxpriceFilter,$limit, $offset, $priceOrder, $order)
    {
        /** @var ActivityRepository $repository */
        $repository = $this->getDoctrine()->getRepository(Activity::class);
        if (!$priceOrder == '$priceOrder' || !($order == 'desc' || $order == 'asc')) {
            $order = 'desc';
        }

        $itemsArr = $repository->findActivityMaxPreparedArr('price', $maxpriceFilter, strtoupper($order),$limit,$offset);
        if (empty($itemsArr)) {
            return new JsonResponse(['error' => 'Nothing found']);
        }
        return new JsonResponse(['activities' => $itemsArr]);
    }

    /**
     * @Route("/popular/{popularFilter}/{limit}/{offset}/{priceOrder}/{order}", defaults={"popularFilter":1, "limit":null, "offset":0, "priceOrder":"", "order":"desc"}, requirements={"popularFilter"="\d+", "page"="\d+", "offset"="\d+"})
     */
    public function popularList($popularFilter,$limit, $offset, $priceOrder, $order)
    {
        /** @var ActivityRepository $repository */
        $repository = $this->getDoctrine()->getRepository(Activity::class);
        if (!$priceOrder == '$priceOrder' || !($order == 'desc' || $order == 'asc')) {
            $order = 'desc';
        }

        $itemsArr = $repository->findActivityPreparedArr('popular', $popularFilter, strtoupper($order),$limit,$offset);
        if (empty($itemsArr)) {
            return new JsonResponse(['error' => 'Nothing found']);
        }
        return new JsonResponse(['activities' => $itemsArr]);
    }

    /**
     * @Route("/category/{categoryFilter}/{limit}/{offset}/{priceOrder}/{order}", defaults={"popularFilter":1, "limit":null, "offset":0, "priceOrder":"", "order":"desc"}, requirements={"page"="\d+", "offset"="\d+"})
     */
    public function categoryList($categoryFilter,$limit, $offset, $priceOrder, $order)
    {
        /** @var ActivityRepository $repository */
        $repository = $this->getDoctrine()->getRepository(Activity::class);
        if (!$priceOrder == '$priceOrder' || !($order == 'desc' || $order == 'asc')) {
            $order = 'desc';
        }
        $categoryRepository = $this->getDoctrine()->getRepository(ActivityCategory::class);
        /** @var ActivityCategory $category */
        $category = $categoryRepository->findOneBy(['name' => $categoryFilter]);
        if (!$category) {
            return new JsonResponse(['error' => 'Nothing found']);
        }
        $categoryId = $category->getId();

        $itemsArr = $repository->findActivityByCategoryPreparedArr($categoryId, strtoupper($order),$limit,$offset);
        return new JsonResponse(['activities' => $itemsArr]);
    }

    /**
     * @Route("/{limit}/{offset}/{priceOrder}/{order}", defaults={"limit":null, "offset":0, "priceOrder":"", "order":"desc"}, requirements={"limit"="\d+", "offset"="\d+"})
     */
    public function list($limit, $offset, $priceOrder, $order)
    {
        /** @var ActivityRepository $repository */
        $repository = $this->getDoctrine()->getRepository(Activity::class);
        if (!$priceOrder == '$priceOrder' || !($order == 'desc' || $order == 'asc')) {
            $order = 'desc';
        }

        $itemsArr = $repository->findActivitiesPreparedArr(strtoupper($order),$limit,$offset);
        if (empty($itemsArr)) {
            return new JsonResponse(['error' => 'Nothing found']);
        }
        return new JsonResponse(['activities' => $itemsArr]);
    }
}