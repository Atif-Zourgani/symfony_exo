<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    //fonction moteur de recherche dans la table sql biography
    public function getByBiography($word)
    {
        // recuperer le query builder ( car c'est le query builder qui  permet de faire la requête SQL )
        $queryBuilder = $this->createQueryBuilder('bio'); // 'a'= non que je lui donne

        // Construire la requête façon SQL, mais en PHP
        //traduire la requete en veritable requete SQL
        $query = $queryBuilder->select('bio')
            ->where('bio.biography LIKE :word ')
            ->setParameter('word', '%'.$word.'%')
            ->getQuery();

        //Executer la requête en base de données pour recuperer les bons livres
        $biography = $query->getArrayResult();

        return $biography;
    }

    // /**
    //  * @return Author[] Returns an array of Author objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Author
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
