<?php


namespace App\Controller;

use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class authorController extends AbstractController
{
    /**
     * //annotation qui donne la route de ma fonction a mon twig ( crée une page web )
     * @Route("/authors", name="authors")
     */
    public function allAuthors(AuthorRepository $authorRepository)
    {
        $author = $authorRepository->findAll();

        return $this->render('authors.html.twig', ['authors' => $author]);

    }

    /**
     * @Route("/author/{id}", name="author_id")
     */
    public function getAuthor(AuthorRepository $authorRepository, $id)
    {

        $author = $authorRepository->find($id);

        return $this->render('author.html.twig', ['author' => $author]);
    }

    /**
     * //
     * @Route("/biography/{word}", name="biography")
     */
    public function  getAuthorsByBiography (AuthorRepository $authorRepository, $word)
    {

        $biography = $authorRepository->getByBiography($word);

        return $this->render('author.html.twig', ['biography' => $biography]);
    }

    /**
     * @Route("/authors/insert", name="authors_insert")
     */
    public function insertAuthors ()
    {
        return $this->render('authors_insert.html.twig');
    }

    /**
     * @Route("/authors/insert_ok", name="authors_insert_ok")
     */
    public function insertAuthorsOk (/**EntityManagerInterface $entityManager, Request $request**/)
    {

        /** ( new \DateTime('NOW')) **/
    }

}