<?php

namespace App\Repository;

use App\Entity\StaffScheduleSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StaffScheduleSettings>
 *
 * @method StaffScheduleSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method StaffScheduleSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method StaffScheduleSettings[]    findAll()
 * @method StaffScheduleSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StaffScheduleSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StaffScheduleSettings::class);
    }
    public function save(StaffScheduleSettings $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
//    /**
//     * @return StaffScheduleSettings[] Returns an array of StaffScheduleSettings objects
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

//    public function findOneBySomeField($value): ?StaffScheduleSettings
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
