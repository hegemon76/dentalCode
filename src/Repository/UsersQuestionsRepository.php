<?php

namespace App\Repository;

use App\Entity\UsersQuestions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UsersQuestions|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsersQuestions|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsersQuestions[]    findAll()
 * @method UsersQuestions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersQuestionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsersQuestions::class);
    }

    // /**
    //  * @return UsersQuestions[] Returns an array of UsersQuestions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UsersQuestions
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
