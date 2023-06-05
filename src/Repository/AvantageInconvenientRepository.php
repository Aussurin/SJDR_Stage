<?php

namespace App\Repository;

use App\Entity\AvantageInconvenient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AvantageInconvenient>
 *
 * @method AvantageInconvenient|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvantageInconvenient|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvantageInconvenient[]    findAll()
 * @method AvantageInconvenient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvantageInconvenientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AvantageInconvenient::class);
    }

    public function save(AvantageInconvenient $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AvantageInconvenient $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AvantageInconvenient[] Returns an array of AvantageInconvenient objects
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

//    public function findOneBySomeField($value): ?AvantageInconvenient
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
