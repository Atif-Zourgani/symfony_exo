<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function getByGenre()
    {
        // recuperer le query builder ( car c'est le query builder qui  permet de faire la requête SQL )
        $queryBuilder = $this->createQueryBuilder('b'); // 'b'= non que je lui donne

        // Construire la requête façon SQL, mais en PHP
        //traduire la requete en veritable requete SQL
        $query = $queryBuilder->select('b')
            ->where('b.style = :style')
            ->setParameter('style', 'education')
            ->getQuery();

        //Executer la requête en base de données pour recuperer les bons livres
        $books = $query->getArrayResult();// demande de resultats en array mais d'autre possibilité son disponible

        return $books;
    }

    // /**
    //  * @return Book[] Returns an array of Book objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Book
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
