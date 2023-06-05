<?php

namespace App\Repository;

use App\Entity\SkillPersonnage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SkillPersonnage>
 *
 * @method SkillPersonnage|null find($id, $lockMode = null, $lockVersion = null)
 * @method SkillPersonnage|null findOneBy(array $criteria, array $orderBy = null)
 * @method SkillPersonnage[]    findAll()
 * @method SkillPersonnage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkillPersonnageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SkillPersonnage::class);
    }

    public function save(SkillPersonnage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SkillPersonnage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SkillPersonnage[] Returns an array of SkillPersonnage objects
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

//    public function findOneBySomeField($value): ?SkillPersonnage
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
