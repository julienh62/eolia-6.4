<?php

namespace App\Repository;

use App\Entity\StaffSchedule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StaffSchedule>
 *
 * @method StaffSchedule|null find($id, $lockMode = null, $lockVersion = null)
 * @method StaffSchedule|null findOneBy(array $criteria, array $orderBy = null)
 * @method StaffSchedule[]    findAll()
 * @method StaffSchedule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StaffScheduleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StaffSchedule::class);
    }

//    /**
//     * @return StaffSchedule[] Returns an array of StaffSchedule objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StaffSchedule
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
