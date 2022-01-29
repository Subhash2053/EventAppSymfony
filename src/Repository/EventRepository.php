<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public const PAGINATOR_PER_PAGE = 2;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }


    public function getEventPaginator(bool $includeFinishedEvents = false,bool $includeUpcomingEvents = false, int $offset): Paginator
    {
        $qb = $this->createQueryBuilder('p') 
        ->orderBy('p.sdate', 'ASC');

        $today= date('Y-m-d');
        if (!$includeUpcomingEvents) {
            $qb->andWhere('p.sdate > :today')
            ->setParameter('today', $today);
        }
        if (!$includeFinishedEvents) {
            $qb->andWhere('p.edate < :today')
            ->setParameter('today', $today);
        }

          
        $qb->setMaxResults(self::PAGINATOR_PER_PAGE)
           ->setFirstResult($offset);
    
       $query = $qb->getQuery();
        return new Paginator($query);
    }



    // /**
    //  * @return Event[] Returns an array of Event objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Event
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
