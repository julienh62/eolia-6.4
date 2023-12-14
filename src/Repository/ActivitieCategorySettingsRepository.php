<?php

namespace App\Repository;

use App\Entity\ActivitieCategorySettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ActivitieCategorySettings>
 *
 * @method ActivitieCategorySettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActivitieCategorySettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActivitieCategorySettings[]    findAll()
 * @method ActivitieCategorySettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivitieCategorySettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActivitieCategorySettings::class);
    }

//    /**
//     * @return ActivitieCategorySettings[] Returns an array of ActivitieCategorySettings objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ActivitieCategorySettings
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
