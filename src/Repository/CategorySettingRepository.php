<?php

namespace App\Repository;

use App\Entity\CategorySetting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategorySetting>
 *
 * @method CategorySetting|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorySetting|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorySetting[]    findAll()
 * @method CategorySetting[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorySettingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorySetting::class);
    }

//    /**
//     * @return CategorySetting[] Returns an array of CategorySetting objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CategorySetting
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
