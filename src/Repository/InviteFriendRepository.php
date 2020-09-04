<?php

namespace App\Repository;

use App\Entity\InviteFriend;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InviteFriend|null find($id, $lockMode = null, $lockVersion = null)
 * @method InviteFriend|null findOneBy(array $criteria, array $orderBy = null)
 * @method InviteFriend[]    findAll()
 * @method InviteFriend[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InviteFriendRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InviteFriend::class);
    }

    // /**
    //  * @return InviteFriend[] Returns an array of InviteFriend objects
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
    public function findOneBySomeField($value): ?InviteFriend
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
