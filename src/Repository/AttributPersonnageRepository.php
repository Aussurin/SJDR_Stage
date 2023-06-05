<?php

namespace App\Repository;

use App\Entity\AttributPersonnage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AttributPersonnage>
 *
 * @method AttributPersonnage|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttributPersonnage|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttributPersonnage[]    findAll()
 * @method AttributPersonnage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttributPersonnageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttributPersonnage::class);
    }

    public function save(AttributPersonnage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AttributPersonnage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AttributPersonnage[] Returns an array of AttributPersonnage objects
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

//    public function findOneBySomeField($value): ?AttributPersonnage
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
