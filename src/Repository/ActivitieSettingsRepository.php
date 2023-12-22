<?php

namespace App\Repository;

use App\Entity\ActivitieSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ActivitieSettings>
 *
 * @method ActivitieSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActivitieSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActivitieSettings[]    findAll()
 * @method ActivitieSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivitieSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActivitieSettings::class);
    }
    public function save(ActivitieSettings $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
//    /**
//     * @return ActivitieSettings[] Returns an array of ActivitieSettings objects
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

//    public function findOneBySomeField($value): ?ActivitieSettings
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
