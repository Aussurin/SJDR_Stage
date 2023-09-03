<?php

namespace App\Repository;

use App\Entity\Attribut;
use App\Entity\AttributPersonnage;
use App\Entity\FicheVampire;
use App\Entity\Progression;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FicheVampire>
 *
 * @method FicheVampire|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheVampire|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheVampire[]    findAll()
 * @method FicheVampire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheVampireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheVampire::class);
    }

    public function save(FicheVampire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FicheVampire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function trouverUneFicheId($value): array
    {
        return $this->createQueryBuilder('f')
            ->Where('f.id = :val')
            ->setParameter('val', $value)
            ->leftJoin('f.progression', 'p')
            ->leftJoin('p.attributs', 'at')
            ->leftJoin('at.attribut', 'a')
            ->leftJoin('p.skills', 'sk')
            ->leftJoin('sk.skill', 's')
            ->leftJoin('p.pointsCreation', 'pc')
            ->leftJoin('pc.avantageInconvenient', 'av')
            ->leftJoin('p.pouvoirPerso', 'pp')
            ->leftJoin('pp.pouvoirs', 'po')
            ->leftJoin('p.predateur', 'pr')
            ->addSelect('p', 'at', 'a', 'sk', 's', 'pc', 'pp', 'po', 'pr')

            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?FicheVampire
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
