<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Room;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Room|null find($id, $lockMode = null, $lockVersion = null)
 * @method Room|null findOneBy(array $criteria, array $orderBy = null)
 * @method Room[]    findAll()
 * @method Room[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Room::class);
    }

    // /**
    //  * @return Room[] Returns an array of Room objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Room
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findRoomByCategory(Category $category) : Array
    {
     return $this->getSearchQuery($category)
         ->orderBy('r.id','DESC')
         ->getQuery()
         ->getResult();

    }

    public function getSearchQuery(Category $category)
    {
        $query = $this->createQueryBuilder('r')
            ->andWhere('r.category = :id')
            ->setParameter('id',$category->getId());

        return $query;
    }

    public function findByCity($city)
    {
        return $this->createQueryBuilder('r')
            ->where('r.city LIKE :city')
            ->setParameter('city','%'.$city.'%')
            ->orderBy('r.city','DESC')
            ->getQuery()
            ->getResult();
    }

}
